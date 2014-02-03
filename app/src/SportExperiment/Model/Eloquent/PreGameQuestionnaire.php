<?php namespace SportExperiment\Model\Eloquent;

class PreGameQuestionnaire extends BaseEloquent
{
    public static $TABLE_KEY = 'pre_game_questionnaire';

    public static $ID_KEY = 'id';
    public static $SUBJECT_ID_KEY = 'subject_id';
    public static $TV_FAN_KEY = 'tv_fan';
    public static $ACTION_DRAMA_FAN_KEY = 'action_drama_fan';
    public static $MEASURE_LIKE_NCIS_KEY = 'measure_like_ncis_team';
    public static $MEASURE_LIKE_NCIS_LA_KEY = 'measure_like_ncis_la_team';
    public static $MEASURE_LIKE_PERSON_OF_INTEREST_KEY = 'measure_like_person_of_interest';

    public static $OPTION_RANGE = [1=>'1', 2=>'2', 3=>'3', 4=>'4', 5=>'5', 6=>'6', 7=>'7'];

    public $timestamps = true;

    protected $rules;
    protected $table;
    protected $fillable;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->table = self::$TABLE_KEY;

        $this->rules = [
            self::$TV_FAN_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$ACTION_DRAMA_FAN_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$MEASURE_LIKE_NCIS_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$MEASURE_LIKE_NCIS_LA_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
            self::$MEASURE_LIKE_PERSON_OF_INTEREST_KEY=>['required', 'in:0,1,2,3,4,5,6,7'],
        ];

        $this->fillable = [
            self::$TV_FAN_KEY, self::$ACTION_DRAMA_FAN_KEY, self::$MEASURE_LIKE_NCIS_KEY,
            self::$MEASURE_LIKE_NCIS_LA_KEY, self::$MEASURE_LIKE_PERSON_OF_INTEREST_KEY
        ];

        parent::__construct($attributes);
    }

    /* ---------------------------------------------------------------------
     * Model Relationships
     * ---------------------------------------------------------------------*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::getNamespace(), self::$SUBJECT_ID_KEY);
    }

    /* ---------------------------------------------------------------------
     * Getters and Setters
     * ---------------------------------------------------------------------*/

    public static function getOptionRange()
    {
        return self::$OPTION_RANGE;
    }

    /**
     * Returns the TV fan key.
     *
     * @return string
     */
    public static function getTvFanKey()
    {
        return self::$TV_FAN_KEY;
    }

    /**
     * Returns the football fan key.
     *
     * @return string
     */
    public static function getActionDramaFanKey()
    {
        return self::$ACTION_DRAMA_FAN_KEY;
    }

    /**
     * Returns the measure of favored team key.
     *
     * @return string
     */
    public static function getMeasureLikeNcisKey()
    {
        return self::$MEASURE_LIKE_NCIS_KEY;
    }

    public static function getMeasureLikeNcisLaKey()
    {
        return self::$MEASURE_LIKE_NCIS_LA_KEY;
    }

    public static function getMeasureLikePersonOfInterestKey()
    {
        return self::$MEASURE_LIKE_PERSON_OF_INTEREST_KEY;
    }

}