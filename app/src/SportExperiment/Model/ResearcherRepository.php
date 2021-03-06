<?php namespace SportExperiment\Model;

use SportExperiment\Model\Eloquent\SubjectEntryState;
use SportExperiment\Model\Eloquent\TrustTreatment;
use SportExperiment\Model\Eloquent\UltimatumTreatment;
use SportExperiment\Model\Eloquent\User;
use SportExperiment\Model\Eloquent\Subject;
use SportExperiment\Model\Eloquent\Session;
use SportExperiment\Model\Eloquent\RiskAversionTreatment;
use SportExperiment\Model\Eloquent\WillingnessPayTreatment;
use SportExperiment\Model\Eloquent\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use SportExperiment\Model\Eloquent\SubjectState;
use SportExperiment\Model\Eloquent\SessionState;
use SportExperiment\Model\Eloquent\DictatorTreatment;

class ResearcherRepository implements ResearcherRepositoryInterface
{
    public function isResearcher(User $user)
    {
        $userModel = User::where('username', $user->getUserName())
            ->where('role', UserRole::$RESEARCHER)
            ->where('active', true)->first();

        // Researcher not found
        if ($userModel == null)
            return false;

        return Hash::check($user->getPassword(), $userModel->password);
    }

    private function createSessionSubjects(Session $session)
    {
        /* @var \SportExperiment\Model\Eloquent\Subject[] $subjects */
        $subjects = [];
        $id = $this->getNextUserId();
        for ($i = 0; $i < $session->getNumSubjects(); ++$i, ++$id) {
            $user = $this->createUserAccount($id);
            $subjects[$i] = $this->createSubject($session, $user);

            $subjectEntryState = new SubjectEntryState();
            $subjectEntryState->subject()->associate($subjects[$i]);
            $subjectEntryState->setTaskId($subjects[$i]->getSession()->getFirstTask()->getTreatmentTaskId());
            $subjectEntryState->save();
        }

        if ($session->getUltimatumTreatment() !== null) {
            $ultimatumProposerRole = UltimatumTreatment::getProposerRoleId();
            $ultimatumReceiverRole = UltimatumTreatment::getReceiverRoleId();

            $ultimatumGroups = TwoPlayerMatcher::matchSubjects($subjects, $ultimatumProposerRole, $ultimatumReceiverRole);

            $ultimatumTreatment = new UltimatumTreatment();
            $ultimatumTreatment->saveGroups($ultimatumGroups);
        }

        if ($session->getTrustTreatment() !== null) {
            $trustProposerRole = TrustTreatment::getProposerRoleId();
            $trustReceiverRole = TrustTreatment::getReceiverRoleId();

            $trustGroups = TwoPlayerMatcher::matchSubjects($subjects, $trustProposerRole, $trustReceiverRole);

            $trustTreatment = new TrustTreatment();
            $trustTreatment->saveGroups($trustGroups);
        }

        if ($session->getDictatorTreatment() !== null) {
            $trustTreatment = new DictatorTreatment();
            $trustTreatment->setSubjectGroups($subjects);
        }
    }

    public function createSubject(Session $session, User $user)
    {
        $subject = new Subject();

        $subject->setState(SubjectState::$REGISTRATION);
        $subject->session()->associate($session);
        $subject->user()->associate($user);
        $subject->save();
        return $subject;
    }

    private function getNextUserId()
    {
        return DB::table(Subject::$TABLE_KEY)->max(Subject::$ID_KEY) + 1;
    }

    /**
     * @param int $id
     * @return User
     */
    public function createUserAccount($id)
    {
        $user = new User();
        $user->setUserName("$id");
        $user->setPassword(Hash::make("pass$id"));
        $user->setRole(UserRole::$SUBJECT);
        $user->setActive(true);
        $user->save();
        return $user;
    }

    public function saveSession(ModelCollection $modelCollection)
    {
        $session = $modelCollection->getModel(Session::getNamespace());
        $session->setState(SessionState::$STOPPED);
        $session->save();

        /* @var \SportExperiment\Model\Eloquent\RiskAversionTreatment $riskAversion */
        $riskAversion = $modelCollection->getModel(RiskAversionTreatment::getNamespace());
        if ($riskAversion !== null) {
            $riskAversion->session()->associate($session);
            $riskAversion->setTreatmentTaskId(RiskAversionTreatment::getTaskId());
            $riskAversion->save();
        }

        /* @var \SportExperiment\Model\Eloquent\WillingnessPayTreatment $willingnessPay */
        $willingnessPay = $modelCollection->getModel(WillingnessPayTreatment::getNamespace());
        if ($willingnessPay !== null) {
            $willingnessPay->session()->associate($session);
            $willingnessPay->setTreatmentTaskId(WillingnessPayTreatment::getTaskId());
            $willingnessPay->save();
        }

        /* @var \SportExperiment\Model\Eloquent\UltimatumTreatment $ultimatum */
        $ultimatum = $modelCollection->getModel(UltimatumTreatment::getNamespace());
        if ($ultimatum !== null) {
            $ultimatum->session()->associate($session);
            $ultimatum->setTreatmentTaskId(UltimatumTreatment::getTaskId());
            $ultimatum->save();
        }

        /* @var \SportExperiment\Model\Eloquent\TrustTreatment $trust */
        $trust = $modelCollection->getModel(TrustTreatment::getNamespace());
        if ($trust !== null) {
            $trust->setTreatmentTaskId(TrustTreatment::getTaskId());
            $trust->session()->associate($session);
            $trust->save();
        }

        /* @var \SportExperiment\Model\Eloquent\DictatorTreatment $dictator */
        $dictator = $modelCollection->getModel(DictatorTreatment::getNamespace());
        if ($dictator !== null) {
            $dictator->setTreatmentTaskId(DictatorTreatment::getTaskId());
            $dictator->session()->associate($session);
            $dictator->save();
        }

        $this->createSessionSubjects($session);
    }

    public function getSession($id)
    {
        return Session::find($id);
    }

    public function getSessions()
    {
        return Session::all();
    }

    public function getSubjects()
    {
        return Subject::all();
    }
}
