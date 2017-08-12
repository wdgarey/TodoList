<?php
class Task
{
  public function Task()
  {
    $this->SetCompleted (false);
    $this->SetDeadline (false);
    $this->SetDescription (false);
    $this->SetId (false);
    $this->SetTitle (false);
  }

  public function Initialize ($array)
  {
    if (isset ($array['id']))
    { $this->SetId ($array['id']); }
    if (isset ($array['title']))
    { $this->SetTitle ($array['title']); }
    if (isset ($array['description']))
    { $this->SetDescription ($array['description']); }
    if (isset ($array['deadline']))
    { $this->SetDeadline ($array['deadline']); }
    if (isset ($array['completed']))
    { $this->SetCompleted ($array['completed']); }
  }

  public function IsCompletedSet () { return $this->IsVarSet ($this->GetCompleted ()); }
  public function IsDeadlineSet () { return $this->IsVarSet ($this->GetDeadline ()); }
  public function IsDescriptionSet () { return $this->IsVarSet ($this->GetDescription ()); }
  public function IsIdSet () { return $this->IsVarSet ($this->GetId ()); }
  public function IsTitleSet () { return $this->IsVarSet ($this->GetTitle ()); }

  protected function IsVarSet ($var) { return !(empty ($var)); }

  private $m_completed;
  private $m_deadline;
  private $m_description;
  private $m_id;
  private $m_title;

  public function GetCompleted () { return $this->m_completed; }
  public function GetDeadline () { return $this->m_deadline; }
  public function GetDescription () {return $this->m_description; }
  public function GetId () { return $this->m_id; }
  public function GetTitle () { return $this->m_title; }

  public function SetCompleted ($completed) { $this->m_completed = $completed; }
  public function SetDeadline ($deadline) { $this->m_deadline = $deadline; }
  public function SetDescription ($description) { $this->m_description = $description; }
  public function SetId ($id) { $this->m_id = $id; }
  public function SetTitle ($title) { $this->m_title = $title; }
}
?>
