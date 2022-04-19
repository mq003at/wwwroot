var ref = firebase.database().ref();
var employee_data_path = "shop_data/" + shop_id + "/employee_data/";
var employee_data_ref = ref.child("shop_data/" + shop_id + "/employee_data");
var authorised_id_ref = ref.child("shop_events/" + shop_id + "/authorised_id");
var authorised_id_path = "shop_events/" + shop_id + "/authorised_id/";

