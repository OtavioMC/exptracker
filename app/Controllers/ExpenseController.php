<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExpenseModel;
use CodeIgniter\HTTP\ResponseInterface;

class ExpenseController extends BaseController
{
    public function list()
    {
        $expenseModel = new ExpenseModel();

        $expenses = $expenseModel->orderBy("operationDate", "desc")->findAll();
        $data['expenses'] = $expenses;

        echo view("templates/header");
        echo view("expenses/list", $data);
        echo view("templates/footer");
    }

    public function create()
    {
        $data = $this->request->getVar();

        $expenseModel = new ExpenseModel();

        $expenseModel->insert($data);

        return redirect()->to('/expenses/list?alert=successCreate');
    }

    public function delete($id)
    {
        $expenseModel = new ExpenseModel();

        $expenseModel->where('id', $id)->delete();
        return redirect()->to('/expenses/list?alert=successDelete');
    }

    public function update()
    {

        $data = $this->request->getJSON(true);

        $expenseModel = new ExpenseModel();

        $expenseModel->where('id', $data['id'])->set($data)->update();

        return redirect()->to('/expenses/list?alert=successEdit');
    }
}
