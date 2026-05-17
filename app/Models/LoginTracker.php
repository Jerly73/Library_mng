<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;

class LoginTracker extends Model
{
    /**
     * The timezone stored in the database (UTC — server's DB timezone).
     * This is NOT the timezone shown to the user.
     */
    public const DB_TZ    = 'UTC';

    /**
     * The timezone shown to the user on all logs pages.
     * Your environment shows +08:00, which corresponds to Asia/Manila.
     */
    public const SHOW_TZ  = 'Asia/Manila';

    protected $fillable = [
        'user_id',
        'login_time',
        'logout_time',
    ];

    protected $casts = [
        'login_time'  => 'datetime',
        'logout_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /* ── Internal helpers ── */

    private function dbLogin(): CarbonImmutable
    {
        return CarbonImmutable::instance($this->login_time, self::DB_TZ);
    }

    private function dbLogout(): ?CarbonImmutable
    {
        return $this->logout_time
            ? CarbonImmutable::instance($this->logout_time, self::DB_TZ)
            : null;
    }

    /* ── Accessors (display in SHOW_TZ only) ── */

    public function getLoginLabelAttribute(): string
    {
        return $this->dbLogin()
            ->setTimezone(self::SHOW_TZ)
            ->format('M d, Y - h:i A');
    }

    public function getLogoutLabelAttribute(): ?string
    {
        return $this->dbLogout()
            ? $this->dbLogout()
                ->setTimezone(self::SHOW_TZ)
                ->format('M d, Y - h:i A')
            : null;
    }

    /**
     * Exact session duration with second-precision:
     * "0h 0m 3s" → "2d 14h 7m 42s"
     *
     * Computed as (logout_or_now_epoch − login_epoch) so that DST
     * transitions in the display timezone never corrupt the result.
     * The units are then decomposed into d / h / m / s and formatted
     * skipping zero-leading groups (e.g. 40 seconds → "0h 0m 40s",
     * 2 days 3 hours → "2d 3h 0m 0s").
     */
    public function getDurationAttribute(): string
    {
        if (!$this->login_time) {
            return '0h 0m 0s';
        }

        $login = CarbonImmutable::parse($this->login_time, config('app.timezone'));
        $logout = $this->logout_time
            ? CarbonImmutable::parse($this->logout_time, config('app.timezone'))
            : CarbonImmutable::now(config('app.timezone'));

        $totalSeconds = max(0, $login->diffInSeconds($logout, false));

        $d = intdiv($totalSeconds, 86400);    $totalSeconds %= 86400;
        $h = intdiv($totalSeconds, 3600);     $totalSeconds %= 3600;
        $m = intdiv($totalSeconds, 60);
        $s = $totalSeconds % 60;

        $parts = [];
        if ($d > 0)     $parts[] = $d . 'd';
        if ($h > 0 || isset($parts[0]))  $parts[] = $h . 'h';
        if ($m > 0 || isset($parts[0]) || isset($parts[1])) $parts[] = $m . 'm';
        $parts[] = $s . 's';

        return implode(' ', $parts);
    }

    public function isActive(): bool
    {
        return is_null($this->logout_time);
    }
}
