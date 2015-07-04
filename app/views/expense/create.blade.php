@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Expense</div>
          <div class="panel-body">
              <div class="col-sm-12">
                  <form action="<?php echo URL::to('/expense/store'); ?>" method="POST" name="addExpense" id="addExpense">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Add New Expense</label>
                              </div>
                          </div>

                      </div>
                      <div class="row">

                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="currency_code">Name</label>
                                <input required="required" name="expense_name" type="text" class="form-control" id="expense_name"
                                       placeholder="Expense Name">
                            </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="currency_code">Total Amount</label>
                                  <input required="required" name="expense_amount" type="text" class="form-control" id="expense_amount"
                                         placeholder="Expense Amount">
                              </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="currency_code">Details</label>
                                  <input required="required" name="expense_details" type="text" class="form-control" id="expense_details"
                                         placeholder="Expense Details">
                              </div>
                          </div>
                      <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" id="store_currency"  class="btn btn-primary pull-right">Save</button>
                                </div>
                            </div>
              </form>

              </div>

          </div>
      </div>
<script type="text/javascript">
    $("#expense_amount").keydown(function (e) {
        //alert("dasfd");
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) ||
                    // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>

@stop