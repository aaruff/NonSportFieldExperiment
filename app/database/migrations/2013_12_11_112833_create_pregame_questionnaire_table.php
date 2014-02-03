<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Schema;
use SportExperiment\Model\Eloquent\PreGameQuestionnaire;

class CreatePregameQuestionnaireTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create(PreGameQuestionnaire::$TABLE_KEY, function($table){
            $table->increments(PreGameQuestionnaire::$ID_KEY);
            $table->integer(PreGameQuestionnaire::$SUBJECT_ID_KEY)->unsigned();
            $table->integer(PreGameQuestionnaire::$TV_FAN_KEY)->unsigned();
            $table->integer(PreGameQuestionnaire::$ACTION_DRAMA_FAN_KEY)->unsigned();
            $table->integer(PreGameQuestionnaire::$MEASURE_LIKE_NCIS_KEY)->unsigned();
            $table->integer(PreGameQuestionnaire::$MEASURE_LIKE_NCIS_LA_KEY)->unsigned();
            $table->integer(PreGameQuestionnaire::$MEASURE_LIKE_PERSON_OF_INTEREST_KEY)->unsigned();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop(PreGameQuestionnaire::$TABLE_KEY);
	}

}