<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasFilter;

    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userGroup(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserGroup::class, 'user_group_level', 'level');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'referer_id');
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function userTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserTransaction::class)->orderByDesc('created_at');
    }

    public function notifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function generateUserCode()
    {
        // $code = $this->query("SELECT LEFT(UUID(), 8) AS Code from users where 'Code' not in (select user_code from users) LIMIT 1");
        // if (empty($code)) {
        // 	$code = $this->query("SELECT LEFT(UUID(), 8) AS Code");
        // }

        // $newcode = $code[0][0]['Code'];

        return random_int(100000, 999999);
    }

    public function generateReferCode($code = null)
    {
        // $mobile = str_replace('+', '', $mobile);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyDmUme5WJZP-UOJtx4F-eAAE0xzO0vqoCI',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
		"longDynamicLink": "https://nuweiba.page.link/?link=http://www.facebook.com/nuweibadentalclinic/?ref='.$code.'&apn=net.wordreward.nuweiba&ibi=net.wordreward.nuweiba",
		"suffix": {
				"option": "SHORT"
			}
		}',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        //SHORT UNGUESSABLE

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response, true);

        return $res['shortLink'];
    }

    public function sendNotification($deviceToken = null, $title = null, $message = null)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "to" : "'.$deviceToken.'"
            , 
            "notification": {
                "title": "'.$title.'",
            "body": "'.$message.'",
        }

        }',
            CURLOPT_HTTPHEADER => [
                'Authorization: key=AAAAQI0Z5-A:APA91bF3k6S5-HVrAGvW4qhys_HVj6PGNUtTN_P5R5HI9yX2lY04cW4tbcn8Pflg5PJN7FFG5YlxD6vrGBbj2FjFqk3MKNVfksxmdn3FpH2VXEZv1qTk0hhrEGY2t9sj7vQpaQIE_JmY',
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response, true);

        if (isset($res['success']) && ($res['success'] == 1)) {
            return true;
        }

        return false;
    }

    public static function findByNameOrPhone($term)
    {
        return self::where('name', 'like', "%$term%")->orWhere('phone', 'like', "%$term%")->get();
    }

    public function awardPoints($points)
    {
        $this->increment('total_points', $points);
        $this->increment('points', $points);
        $this->addLevelPoints($points);
    }

    public function addPoints($points)
    {
        $this->increment('points', $points);
        $this->increment('total_points', $points);
    }

    public function addLevelPoints($points)
    {
        $this->increment('level_points', $points);
        $this->qualifyForNextGroup();
    }

    public function redeemPoints($points)
    {
        $this->decrement('points', $points);
        $this->increment('redeemed_points', $points);
    }

    public function qualifyForNextGroup()
    {
        $groups = UserGroup::orderBy('maximum_points')->get();
        $count = 1;
        foreach ($groups as $group) {
            if ($this->level_points > $group->maximum_points) {
                $count++;
            }
        }
        $this->update([
            'user_group_level' => ($count < $groups->count()) ? $count : $groups->count(),
        ]);
    }

    public function hasEnoughPoints(int $points): bool
    {
        return $this->points >= $points;
    }
}
