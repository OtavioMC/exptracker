<?php if( isset($_GET['debugging'])) {
            echo $_GET['debugging'];

            die();
        }

?>


<div class="modal fade" id="new-expense-modal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form action="/expenses/create" method="post">
                  <div class="modal-header">
                      <h4 class="modal-title">New Expense</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-6">
                              <div class="form-group">
                                  <label for=""> Description </label>
                                  <input type="text" class="form-control" name="description">
                              </div>
                          </div>

                          <div class="col-3">
                              <div class="form-group">
                                  <label for=""> Date </label>
                                  <input type="datetime-local"  value="<?= date('Y-m-d H:i') ?>" min="2018-06-07T00:00" max="<?= date('Y-m-d H:i') ?>" class="form-control" name="operationDate">
                              </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                  <label for=""> Value </label>
                                  <input type="number" min="1" step="any" class="form-control" name="value">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <div class="modal fade" id="update-expense-modal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form id="putExpenses" method="post">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Expense</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-6">
                              <div class="form-group">
                                  <label for="">Description</label>
                                  <input type="text" class="form-control" id="expense-description" name="description">
                              </div>
                          </div>

                          <div class="col-3">
                              <div class="form-group">
                                  <label for="">Operation Date </label>
                                  <input type="datetime-local" min="2018-06-07T00:00" max="<?= date('Y-m-d H:i') ?>" class="form-control" id="operation-date" name="operation-date">
                              </div>
                          </div>

                          <div class="col-3">
                              <div class="form-group">
                                  <label for="">Value</label>
                                  <input type="number" min="1" step="any" class="form-control" id="expense-value" name="value">
                              </div>
                          </div>

                          <input type="hidden" id="expense-id" name="id">
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary"  onclick ="updateData()" ><i class="fas fa-save"></i> Save </button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Expenses</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Starter Page</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#new-expense-modal">
                                  <i class="fas fa-plus-circle"></i> New Expense
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
              <?php if (isset($_GET['alert']) && $_GET['alert'] == "successCreate") : ?>
                  <div class="row">
                      <div class="col-12">
                          <div class="alert alert-success alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h5><i class="icon fas fa-check"></i> Success!</h5>
                              Expense registered!
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              <?php if (isset($_GET['alert']) && $_GET['alert'] == "successDelete") : ?>
                  <div class="row">
                      <div class="col-12">
                          <div class="alert alert-success alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h5><i class="icon fas fa-check"></i> Success!</h5>
                              Expense deleted!
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              <?php if (isset($_GET['alert']) && $_GET['alert'] == "successEdit") : ?>
                  <div class="row">
                      <div class="col-12">
                          <div class="alert alert-success alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h5><i class="icon fas fa-check"></i> Success!</h5>
                              Expense updated!
                          </div>
                      </div>
                  </div>
              <?php endif; ?>
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                              <table class="table table-striped table-bordered">
                                  <thead>
                                      <tr>
                                          <th>OPERATION DATE</th>
                                          <th>DESCRIPTION</th>
                                          <th>VALUE</th>
                                          <th>OPTIONS</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($expenses as $expense) : ?>
                                          <tr>
                                              <td><?= $expense['operationDate'] ?></td>
                                              <td><?= $expense['description'] ?></td>
                                              <td><?= $expense['value'] ?></td>
                                              <td>
                                                  <button type="button" class="btn btn-warning" onclick="sendData('<?= $expense['id'] ?>', '<?= $expense['operationDate'] ?>', '<?= $expense['description'] ?>', '<?= $expense['value'] ?>')"><i class="fas fa-edit"></i></button>
                                                  <button type="button" class="btn btn-danger"  onclick="deleteData(<?= $expense['id'] ?>)"><i class="fas fa-trash"></i></button>
                                              </td>
                                          </tr>
                                      <?php endforeach; ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   <script>
        function sendData(id, operationDate, description, value) {
            document.getElementById('expense-id').value = id;
            document.getElementById('operation-date').value = operationDate;
            document.getElementById('expense-description').value = description;
            document.getElementById('expense-value').value = value;

            $('#update-expense-modal').modal('show');
        }

        function deleteData(id){
            fetch(`/expenses/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            window.location.href = "/expenses?alert=successDelete";

        }

        function updateData(){


            let id = document.getElementById('expense-id').value;
            let opDate = document.getElementById('operation-date').value;
            let description = document.getElementById('expense-description').value;
            let value = Math.abs(document.getElementById('expense-value').value);
            value = value.toFixed(2);

            var data = {
                id : id,
                description : description,
                operationDate : opDate,
                value : value
            };
                fetch(`/expenses/update/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });


            event.preventDefault();

            $('#update-expense-modal').modal('hide');

            window.location.href = '/expenses';

        }
    </script>