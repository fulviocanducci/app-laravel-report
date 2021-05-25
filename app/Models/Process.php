<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'person_id',
        'counterpart_id',
        'forum_id',
        'stick_id',
        'district_id',
        'group_action_id',
        'type_action_id',
        'phase_id',
        'stage_id',
        'number_process',
        'protocol',
        'folder',
        'date_request',
        'expectancy',
        'price',
        'percent_fees',
        'description'
    ];


    protected $appends = ['process_person'];

    public function rules($id = '')
    {
        return [
            'person_id' => "required|exists:people,id",
            'counterpart_id' => "required|exists:people,id",
            'forum_id' => "required|exists:forums,id",
            'stick_id' => "required|exists:sticks,id",
            'district_id' => "required|exists:districts,id",
            'group_action_id' => "required|exists:group_actions,id",
            'type_action_id' => "required|exists:type_actions,id",
            'phase_id' => "required|exists:phases,id",
            'stage_id' => "required|exists:stages,id",
            'number_process' => 'required|min:3|unique:processes,id,{$id},id',
            'users' => 'required',

            'progresses.*.date' => 'required',
            'progresses.*.description' => 'required',
            'progresses.*.date_term' => 'required',
            'progresses.*.publication' => 'required',

        ];
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function financials()
    {
        return $this->hasMany(Financial::class, 'process_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function counterPart()
    {
        return $this->belongsTo(Person::class, 'counterpart_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stick()
    {
        return $this->belongsTo(Stick::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function groupAction()
    {
        return $this->belongsTo(GroupAction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeAction()
    {
        return $this->belongsTo(TypeAction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stages()
    {
        return $this->belongsToMany(Stage::class, 'process_stage')
            ->withPivot('user_id')
            ->withTimestamps();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'process_user')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function progresses()
    {
        return $this->hasMany(ProcessProgress::class);
    }


    public function files()
    {
        return $this->hasMany(ProcessFiles::class);
    }


    public function events()
    {
        return $this->hasMany(Event::class);
    }


    public function getProcessPersonAttribute()
    {
        return $this->number_process . ' - ' . $this->person()->first()->name;
    }

    public function setExpectancyAttribute($value)
    {
        $this->attributes['expectancy'] = Helper::replaceDecimal($value);
    }

    public function getExpectancyAttribute($value)
    {
        return Helper::formatDecimal($value, 2);
    }


    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = Helper::replaceDecimal($value);
    }

    public function getPriceAttribute($value)
    {
        return Helper::formatDecimal($value, 2);
    }
}
