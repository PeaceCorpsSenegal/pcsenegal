<?php

class knowledge_tree {
	
	private $subjects;
	private $relationships;
	private $output;

	public function __construct() {
	
		$this->getRelationships();
		$this->getSubjects();
	}
	
	public function printTree($markup) {
		$this->output = '<ul style="margin-top: 0px;">';
		foreach ($this->subjects as $subject) {
			if (!in_array($subject['id'], $this->relationships['children'])) {
				$this->walkTree($subject['id'], $markup);
			}
		}
		$this->output .= '</ul>';
		return $this->output;
	}
	
	private function walkTree($id, $markup) {
		$sql = "select id from knowledge_location where knowledge_subject = $id";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		switch ($markup) {
			case 'links':
				$m1 = $this->subjects[$id]['id'].'<a href="?page=knowledge/knowledge_view.php&id='.$this->subjects[$id]['id'].'&subject='.urlencode($this->subjects[$id]['subject']).'">';
				$m2 = '</a> ('.$count.')';
				break;
			case 'form':
				$m1 = '<input type="text" style="width: 30px;" name="'.$this->subjects[$id]['id'].'">';
				$m2 = '';
				break;
			default:
				die('invalid markup type');
		}
		$this->output .= '<li>'.$m1.$this->subjects[$id]['subject'].$m2;
		if (in_array($id, $this->relationships['parents'])) {
			$this->output .= '<ul style="margin-top: 0px;">';
$sql = "select knowledge_subjects.id, knowledge_subjects.subject, knowledge_collections.child
from knowledge_collections
left join knowledge_subjects
on knowledge_collections.child = knowledge_subjects.id
where parent = $id";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				$new_children[] = $row;
			}
			foreach ($new_children as $new_child) {
				$this->walkTree($new_child['id'], $markup);
				//$subtree[];
			}
		$this->output .= '</ul></li>';
		} else {
			$this->output .= '</li>';
		}
	}
	
	private function getRelationships() {
		// get relationships
		$sql = "select * from knowledge_collections";
		$result = mysql_query($sql);

		while ($row = mysql_fetch_assoc($result)) {
			$this->relationships['parents'][] = $row['parent'];
			$this->relationships['children'][] = $row['child'];
		}
		mysql_free_result($result);
		return $this->relationhsips;
	}
	
	private function getSubjects() {
		// get all subjects
		$sql = "select * from knowledge_subjects";
		$result = mysql_query($sql);

		while ($row = mysql_fetch_assoc($result)) {
			$this->subjects[$row['id']] = $row;
		}
		mysql_free_result($result);
		return $this->subjects;
	}
}

?>