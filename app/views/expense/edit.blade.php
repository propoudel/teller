@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Expense</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/expense/update'); ?>" method="POST" name="addExpense" id="addExpense">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Edit Expense</label>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="currency_code">Name</label>
                                <input required="required" name="expense_name" type="text" value="{{ $data['expense_data_edit']->name }}" class="form-control" id="expense_name"
                                       placeholder="Expense Name">
                            </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="currency_code">Amount</label>
                                  <input required="required" name="expense_amount" type="text" value="{{ $data['expense_data_edit']->amount }}" class="form-control" id="expense_amount"
                                         placeholder="Expense Amount">
                              </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="currency_code">Details</label>
                                  <input required="required" name="expense_details" type="text" value="{{ $data['expense_data_edit']->details }}" class="form-control" id="expense_details"
                                         placeholder="Expense Details">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-12">
                          <input type="hidden" name="id" value="{{ $data['expense_data_edit']->id }}">
                          <button type="submit" id="store_expense" class="btn btn-primary pull-right">Update</button>
                          </div>
                        </div>
                  </form>

              </div>

          </div>
      </div>

@stop
