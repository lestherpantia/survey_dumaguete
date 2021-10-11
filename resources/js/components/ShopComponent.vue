<template>
    <div class="main-container p-5">
        <div class="container-fluid">

            <!---- messagebox ----->

            <div style="position: absolute; top: 0; left: 0; z-index: 1000; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.2);" v-if="err || suc">
                <div style="position: fixed; top: 450px; left: 55%; transform:translate(-50%, -70%)">
                    <div style="width: 500px; background: #F2F4F4;" class="p-3">

                        <div class="message-header p-2 border-bottom d-flex justify-content-between" style="background: #F2F4F4;">
                            <h3 style="margin: 0; font-size: 15px; font-weight: bold" v-if="err">Error Message</h3>
                            <h3 style="margin: 0; font-size: 15px; font-weight: bold" v-if="suc">Success</h3>
                        </div>

                        <!---- error --->
                        <div class="message_box text-center p-3" v-if="err">
                            <h1 style="font-size: 17px;">{{ err_msg }}</h1>
                        </div>

                        <!---- success --->
                        <div class="message_box text-center p-3" v-if="suc">
                            <h1 style="font-size: 17px;">{{ suc_msg }}</h1>
                        </div>

                        <button v-on:click="closeMessageBox" class="form-control btn btn-primary p-2">Ok</button>

                    </div>
                </div>
            </div>


            <!--- header --->

            <div class="row align-items-center mb-3">
                <div class="title col-6">
                    Shop
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success" v-on:click="createModal"><i class="fas fa-plus mr-2"></i>  Add new Shop</button>
                </div>
            </div>

            <!--- table list --->


            <div class="main-content-table">
                <div class="row">
                    <div class="col-md-12">
                        <v-client-table
                            :data="shops_table_data"
                            :columns="columns"
                            :options="options">
                            <span slot="actions" slot-scope="{row}">
                                <button class="btn btn-success mb-2" v-on:click="editRecord(row.id)"><i class="fas fa-edit mr-1"></i>Edit</button>
                                <button class="btn btn-danger mb-2" v-on:click="deleteRecord(row.id)"><i class="fas fa-trash mr-1"></i>Delete</button>
                            </span>
                        </v-client-table>
                    </div>
                </div>
            </div>


            <!---- modal ---->


            <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel" v-if="adding">Add Shop</h5>
                            <h5 class="modal-title" id="exampleModalLabel" v-else>Edit Shop</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="max-height: 500px; overflow: auto;">
                            <div class="text-danger" v-if="errors.length > 0">
                                <ul>
                                    <li v-for="error in errors">{{ error[0] }}</li>
                                </ul>
                            </div>

                            <div class="form-group">
                                <label for="name">Shop Name</label>
                                <input type="text" id="name" class="form-control" v-model="shop.shop_name">

                                <label for="address">Shop Address</label>
                                <input type="text" id="address" class="form-control" v-model="shop.shop_address">

                                <label for="city">City</label>
                                <select class="form-control" id="city" v-model="city_value">
                                    <option v-for="city_data in city_select" v-bind:value="city_data.id">{{ city_data.name }}</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <button class="btn btn-success" v-if="adding" v-on:click="storeRecord"><i class="fas fa-paper-plane mr-2"></i>Submit</button>
                                <button class="btn btn-success" v-else v-on:click="updateRecord"><i class="fas fa-paper-plane mr-2"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>


<script>

export default {
    data() {
        return {
            columns: ['shop_name', 'shop_address', 'city', 'actions'],
            shops_table_data: [],
            options: {
                headings: {
                    shop_name: 'Shop Name',
                    shop_address: 'Shop Address',
                    city: 'City',
                    actions: 'Action'
                },
                sortable: ['shop_name', 'shop_address', 'city'],
                filterable: false,
            },

            shop: [],
            errors: [],
            city_select: [],
            city_value: 1,

            adding: false,
            err_msg: '',
            suc_msg: '',
            err: false,
            suc: false,
        }
    },

    methods: {

        /* close message box */

        closeMessageBox() {

            this.err_msg = '';
            this.suc_msg = '';
            this.err = false;
            this.suc = false
            this.initialData();

        },


        /* error handlers */

        errorHandler(errors){
            let error_handler = [];
            $.each(errors, function(key, value) {
                error_handler.push(value);
            });
            return error_handler;
        },



        /* return success */


        returnSuccess(response) {
            $('#create-modal').modal('hide');
            this.suc = true;
            this.suc_msg = response.data.message;
        },



        /* return failed */


        returnFailed(error) {
            if(error.response.data.err_msg) {
                $('#create-modal').modal('hide');
                this.err = true;
                this.err_msg = error.response.data.err_msg;
                return;
            }
            this.errors = [];
            this.errors = this.errorHandler(error.response.data.errors);
        },



        /* initial data */



        initialData() {

            this.shops_table_data = [];
            this.city_select = [];
            
            axios.get('shops/getdata').then(response => {
                this.shops_table_data = response.data.shops;
                this.city_select = response.data.cities;
            });

        },



        /* create modal */



        createModal() {
            this.adding = true;
            $('#create-modal').modal('show');
        },


        /* store record */


        storeRecord() {
            this.adding = true;
            axios.post('shops/store', {
                shop_name: this.shop.shop_name,
                shop_address: this.shop.shop_address,
                city_id: this.city_value,
            })
            .then(response => {
                this.returnSuccess(response);
            })
            .catch(error => {
                this.returnFailed(error);
            })
        },



        /* edit record */


        editRecord(id) {
            this.adding = false;

            axios.get('shops/edit/' + id)
            .then(response => {
                this.shop.id = response.data.shop.id;
                this.shop = response.data.shop;
            });

            $('#create-modal').modal('show');
        },



        /* update record */



        updateRecord() {
            axios.patch('shops/update', {
                id: this.shop.id,
                shop_name: this.shop.shop_name,
                shop_address: this.shop.shop_address,
                city_id: this.city_value,
            }).then(response => {
                this.returnSuccess(response);
            }).catch(error => {
                this.returnFailed(error);
            });
        },



        
        /* delete record */



        deleteRecord(id) {
            let confirmBox = confirm("Do you want to delete this record?");

            if(confirmBox === true) {

                axios.get('shops/destroy/' + id).then(response => {
                    this.returnSuccess(response);
                }).catch(error => {
                    this.returnFailed(error);  
                }); 

            }

        },

    },

    mounted() {
        this.initialData();
    },
}




</script>