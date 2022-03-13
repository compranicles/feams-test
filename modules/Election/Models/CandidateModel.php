<?php
namespace Modules\Election\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table      = 'candidates';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = ['election_id', 'position_id', 'user_id', 'photo', 'platform'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function view($id) {
        $this->select('candidates.id, users. first_name, users.last_name, positions.name, candidates.position_id, candidates.photo, candidates.platform, users.profile_pic');
        $this->where(['candidates.deleted_at' => NULL, 'candidates.election_id' => $id]);
        $this->join('users', 'users.id = candidates.user_id', 'left');
        $this->join('positions', 'positions.id = candidates.position_id', 'left');
        return $this->get()->getResultArray();
    }

    public function view2($id) {
        $this->select('candidates.id, users. first_name, users.last_name, electoral_positions.position_name as name, candidates.position_id, candidates.photo, candidates.platform, users.profile_pic');
        $this->join('users', 'users.id = candidates.user_id', 'left');
        $this->join('electoral_positions', 'electoral_positions.id = candidates.position_id', 'left');
        $this->where(['candidates.deleted_at' => NULL, 'candidates.election_id' => $id]);
        return $this->get()->getResultArray();
    }
}