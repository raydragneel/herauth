<?php

namespace Raydragneel\Herauth\Controllers\Master;

use Raydragneel\Herauth\Models\HerauthPermissionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class HeraPermission extends BaseHerauthMasterController
{
    protected $modelName = HerauthPermissionModel::class;

    public function index()
    {
        $this->herauth_grant('permission.view_index','page');
        $data = [
            'page_title' => lang("Label.permission"),
            'url_datatable' => herauth_web_url($this->root_view . "permission/datatable"),
            'url_add' => herauth_base_locale_url($this->root_view . "permission/add"),
            'url_edit' => herauth_base_locale_url($this->root_view . "permission/{0}/edit"),
            'url_delete' => herauth_web_url($this->root_view . "permission/{0}/delete"),
            'url_restore' => herauth_web_url($this->root_view . "permission/{0}/restore"),
        ];
        return $this->view("permission/index", $data);
    }

    public function add()
    {
        $this->herauth_grant('permission.view_add','page');
        $data = [
            'page_title' => lang("Label.add")." ".lang("Label.permission"),
            'url_add' => herauth_web_url($this->root_view . "permission/add"),
        ];
        return $this->view("permission/add", $data);
    }
    public function edit($id = null)
    {
        $this->herauth_grant('permission.view_edit','page');
        $permission = $this->model->withDeleted(true)->find($id);
        if (!$permission) {
            throw new PageNotFoundException();
        }

        $data = [
            'page_title' => lang("Label.edit")." ".lang("Label.permission")." " . $permission->name,
            'permission' => $permission,
            'url_edit' => herauth_web_url($this->root_view . "permission/{$id}/edit"),
        ];
        return $this->view("permission/edit", $data);
    }

}
