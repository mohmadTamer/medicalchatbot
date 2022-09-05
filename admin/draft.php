<!-- Start Get doctor data to be updated   -->
<td>
            <button id="updbtn" type="button" class="btn btn-success" onclick="get_camp_data(
                `<?php echo $campaign['c_id'] ?>`,
                `<?php echo $campaign['c_name']?>`,
                `<?php echo $campaign['c_desc']?>`,
                `<?php echo base64_encode( $campaign['c_pic']) ?>`,
                `<?php echo $campaign['c_link'] ?>`,
                `<?php echo $campaign['c_start_date'] ?>`,
                `<?php echo $campaign['c_end_date'] ?>`,)"
                data-toggle="modal" data-target="#exampleModalCenter2"> Update
                </button>
<!-- End Get doctor data to be updated   -->

<!-- Start Update Modal for campaign -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-2" 
role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle2">Update Campaign</h3>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" 
                        id="name_camp" name="cname">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" 
                        id="desc_camp" name="cdescription">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" 
                        id="link_camp" name="clink">
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" 
                        id="img_camp" name="cpic"><br><br>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" 
                        id="sdate_camp" name="cSdate">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" 
                        id="edate_camp" name="cEdate">
                    </div>
                        <input type="submit" name="updatecamp" 
                        class="btn btn-success btn-group-justified" value="Update"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" 
                data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php


// start update query code
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update']) ){

    }
    ?>


function get_camp_data(delete_id, update_id , name , description_data , campimg , camplink , 
campSdate, campEdate)
{
let get_update_id = document.getElementById('get_id');
let get_delete_id = document.getElementById('get_d_id');
let campaign_name = document.getElementById('name_camp');
let campaign_desc = document.getElementById('desc_camp');
// let campaign_img = document.getElementById('img_camp');
let campaign_link = document.getElementById('link_camp');
// let campaign_sdate = document.getElementById('sdate_camp');
// let campaign_edate = document.getElementById('edate_camp');

get_update_id.value=update_id;
get_delete_id.value = delete_id;
campaign_name.value = name;
campaign_desc.value = description_data;
// campaign_img.value = campimg;
campaign_link.value = camplink;
// campaign_sdate.value = campSdate;
// campaign_edate.value = campEdate;

}