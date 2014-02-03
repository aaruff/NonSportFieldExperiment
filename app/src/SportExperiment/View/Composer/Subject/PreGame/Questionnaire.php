<?php namespace SportExperiment\View\Composer\Subject\PreGame;

use SportExperiment\Model\NFLTeams;
use SportExperiment\View\Composer\BaseComposer;
use SportExperiment\Controller\Subject\PreGame\Questionnaire as PreGameQuestionnaireController;
use SportExperiment\Model\Eloquent\PreGameQuestionnaire as PreGameQuestionnaireModel;
use Illuminate\Support\Facades\URL;

class Questionnaire extends BaseComposer
{
    public static $VIEW_PATH = 'site.subject.pregame.questionnaire';

    public function compose($view)
    {
        $view->with('postUrl', URL::to(PreGameQuestionnaireController::getRoute()));

        $view->with('tvFan', PreGameQuestionnaireModel::$TV_FAN_KEY);
        $view->with('tvFanOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], PreGameQuestionnaireModel::getOptionRange()));

        $view->with('actionDramaFan', PreGameQuestionnaireModel::$ACTION_DRAMA_FAN_KEY);
        $view->with('actionDramaFanOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], PreGameQuestionnaireModel::getOptionRange()));

        $view->with('measureLikeNcis', PreGameQuestionnaireModel::$MEASURE_LIKE_NCIS_KEY);
        $view->with('measureLikeNcisOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], PreGameQuestionnaireModel::getOptionRange()));

        $view->with('measureLikeNcisLa', PreGameQuestionnaireModel::$MEASURE_LIKE_NCIS_LA_KEY);
        $view->with('measureLikeNcisLaOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], PreGameQuestionnaireModel::getOptionRange()));

        $view->with('measureLikePersonOfInterest', PreGameQuestionnaireModel::$MEASURE_LIKE_PERSON_OF_INTEREST_KEY);
        $view->with('measureLikePersonOfInterestOptions', array_merge(['default'=>'Select A Number Between 1 - 7'], PreGameQuestionnaireModel::getOptionRange()));
    }

} 