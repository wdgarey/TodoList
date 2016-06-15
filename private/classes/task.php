<?php
class Task
{
  public function Task()
  {
    $this->SetCompleted (-1);
    $this->SetDeadline (-1);
    $this->SetDescription (-1);
    $this->SetId (-1);
    $this->SetInterim (-1);
    $this->SetTitle (-1);
  }

  public function IsCompletedSet () { return $this->IsVarSet ($this->GetCompleted ()); }
  public function IsDeadlineSet () { return $this-IsVarSet ($this->GetDeadline ()); }
  public function IsDescriptionSet () { return $this->IsVarSet ($this->GetDescription ()); }
  public function IsIdSet () { return $this->IsVarSet ($this->GetId ()); }
  public function IsInterimSet () { return $this->IsVarSet ($this->GetInterim ()); }
  public function IsTitleSet () { return $this->IsVarSet ($this->GetTitle ()); }

  protected function IsVarSet ($var) { return ($var !== -1); }

  private $m_completed;
  private $m_deadline;
  private $m_description;
  private $m_id;
  private $m_interim;
  private $m_title;

  public function GetCompleted () { return $this->m_completed; }
  public function GetDeadline () { return $this->m_deadline; }
  public function GetDescription () {return $this->m_description; }
  public function GetId () { return $this->m_id; }
  public function GetInterim () { return $this->m_interim; }
  public function GetTitle () { return $this->m_title; }

  public function SetCompleted ($completed) { $this->m_completed = $completed; }
  public function SetDeadline ($deadline) { $this->m_deadline = $deadline; }
  public function SetDescription ($description) { $this->m_description = $description; }
  public function SetId ($id) { $this->m_id = $id; }
  public function SetInterim ($interim) { $this->m_interim = $interim; }
  public function SetTitle ($title) { $this->m_title = $title; }
}
?>
