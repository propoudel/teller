@extends("layout")
@section("content")

  <div class="panel panel-default">
          <div class="panel-heading">Report{Under progres}</div>
          <div class="panel-body">

 <div class="col-sm-12">
                 <form>

                     <div class="row">
                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="from">From</label>
                                 <input class="form-control datepicker" name="from" type="text" placeholder="From Date">
                             </div>
                         </div>

                         <div class="col-sm-3">
                             <div class="form-group">
                                 <label for="to">To</label>
                                 <input type="text" class="form-control datepicker" id="to" placeholder="To Date">
                             </div>
                         </div>

                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label for="sendcurrency">Currency</label>
                                 <input type="text" class="form-control" id="sendcurrency" placeholder="Currency">
                             </div>
                         </div>

                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label for="rate">Rate</label>
                                 <input type="email" class="form-control" id="rate" placeholder="Rate">
                             </div>
                         </div>


                         <div class="col-sm-2">
                             <div class="form-group">
                                 <label> &nbsp; </label>

                                 <button class=" form-control btn btn-primary">Search</button>
                             </div>
                         </div>
                     </div>


                     <div class="row">
                         <div class="col-sm-12">
                             <div class="bs-example" data-example-id="bordered-table">
                                 <table class="table table-bordered">
                                     <thead>
                                     <tr>
                                         <th><a translationcount="" class="sortable" href="/teller/tellerapp/web/app_dev.php/dashboard/report?sort=a.id&amp;direction=asc&amp;page=1" title="SN">SN</a>
 </th>
                                         <th>Name</th>
                                         <th><a translationcount="" class="sortable" href="/teller/tellerapp/web/app_dev.php/dashboard/report?sort=a.receivedMoney&amp;direction=asc&amp;page=1" title="DR">DR</a>
 </th>
                                         <th><a translationcount="" class="sortable" href="/teller/tellerapp/web/app_dev.php/dashboard/report?sort=a.totalTransferredMoney&amp;direction=asc&amp;page=1" title="CR">CR</a>
 </th>
                                         <th>Details</th>
                                     </tr>
                                     </thead>
                                     <tbody>


                                                                             <tr>
                                             <th scope="row">1</th>
                                             <td>Admin</td>
                                             <td>3</td>
                                             <td>9</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">2</th>
                                             <td>Admin</td>
                                             <td>434</td>
                                             <td>1736</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">3</th>
                                             <td>Admin</td>
                                             <td>3</td>
                                             <td>9</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">4</th>
                                             <td>Admin</td>
                                             <td>35</td>
                                             <td>175</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">5</th>
                                             <td>Admin</td>
                                             <td>3</td>
                                             <td>9</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">6</th>
                                             <td>Admin</td>
                                             <td>3</td>
                                             <td>9</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">7</th>
                                             <td>Admin</td>
                                             <td>4</td>
                                             <td>16</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">8</th>
                                             <td>Admin</td>
                                             <td>3</td>
                                             <td>9</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">9</th>
                                             <td>Admin</td>
                                             <td>3</td>
                                             <td>9</td>
                                             <td>Coming soon. orm</td>
                                         </tr>


                                                                             <tr>
                                             <th scope="row">10</th>
                                             <td>Admin</td>
                                             <td>2</td>
                                             <td>12</td>
                                             <td>Coming soon. orm</td>
                                         </tr>



                                     </tbody>
                                 </table>
                             </div>
                             <nav class="pull-right">


 <div class="pagination">


                         <span class="current">1</span>

                         <span class="page">
                 <a href="/teller/tellerapp/web/app_dev.php/dashboard/report?page=2">2</a>
             </span>

                         <span class="page">
                 <a href="/teller/tellerapp/web/app_dev.php/dashboard/report?page=3">3</a>
             </span>

                         <span class="page">
                 <a href="/teller/tellerapp/web/app_dev.php/dashboard/report?page=4">4</a>
             </span>


             <span class="next">
             <a href="/teller/tellerapp/web/app_dev.php/dashboard/report?page=2">&gt;</a>
         </span>

             <span class="last">
             <a href="/teller/tellerapp/web/app_dev.php/dashboard/report?page=4">&gt;&gt;</a>
         </span>
     </div>



                             </nav>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-sm-12">
                             <button class="btn btn-primary pull-right">Export</button>
                         </div>
                     </div>
                 </form>

             </div>
          </div>
      </div>

@stop
