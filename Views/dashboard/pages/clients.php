<?php
    $getOrders = Model\Model::getWhere('orders',"WHERE `vendor_id` = '$_SESSION[user_id]'");
    $getOrdersUniq = array_unique(array_column($getOrders,'user_id'));
?>
<section class="clients">
    <div class="card-head">
        <h6>Clients</h6>
    </div>


    <div class="columns-four">
        <div class="box columns-two-bedroom">
            <div>
                <span class="sub">Total Users</span>
                <h2>72,540</h2>
            </div>
            <div>
                <div class="chart" id="chart-clients"></div> 
            </div>
            <div class="badge success"><p><i data-feather="activity"></i> 12,5</p></div>
        </div>

        <div class="box columns-two-bedroom">
            <div>
                <span class="sub">Total Users</span>
                <h2>72,540</h2>
            </div>
            <div>
                <div class="chart" id="chart-sessions"></div> 
            </div>
            <div class="badge success"><p><i data-feather="activity"></i> 12,5</p></div>
        </div>

        <div class="box columns-two-bedroom">
            <div>
                <span class="sub">Total Users</span>
                <h2>72,540</h2>
            </div>
            <div>
                <div class="chart" id="chart-orders"></div> 
            </div>
            <div class="badge success"><p><i data-feather="activity"></i> 12,5</p></div>
        </div>

        <div class="box columns-two-bedroom">
            <div>
                <span class="sub">Total Users</span>
                <h2>72,540</h2>
            </div>
            <div>
                <div class="chart" id="chart-payments"></div> 
            </div>
            <div class="badge success"><p><i data-feather="activity"></i> 12,5</p></div>
        </div>
    </div>


    <div class="column-one">
        <div class="container">
            <div class="card-head">
                <h5>Import data into Front Dashboard</h5>
            </div>
            <table class="columns-six">
                <thead>
                    <tr>
                        <td>Full Name</td>
                        <td>Status</td>
                        <td>Type</td>
                        <td>Email</td>
                        <td>Signed</td>
                        <td>User ID</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($getOrdersUniq as $key => $value){
                            $getClient = Model\Model::getOne('users',"WHERE `id` = '$value'");
                    ?>
                    <tr>
                        <td class="two">
                            <div><img class="user" src="<?php echo INCLUDE_PATH ?>assets/amanda-doe.jpg"/></div>
                            <div><h4><?php echo $getClient['name']; ?></h4></div>
                        </td>
                        <td><div class="status active"></div> Success</td>
                        <td><?php echo $getClient['email']; ?></td>
                        <td><?php echo $getClient['function']; ?></td>
                        <td><?php echo $value; ?></td>
                        <td><?php echo $getClient['cep']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>