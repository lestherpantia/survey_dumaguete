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

            <div class="title col-12 p-0">
                Survey Number
            </div>

            <!---- filters --->

            
            <div class="col-12 p-0">

                <div class="card">
                    <div class="card-body">

                        <label style="font-weight: bold !important" for="city">Select City</label>
                            <select id="city" class="form-control mb-1" v-model="city_value" v-on:change="getShop">
                                <option v-for="city_data in city_select" v-bind:value="city_data.id">{{ city_data.name }}</option>
                            </select>

                        <label style="font-weight: bold !important" for="shop">Select Shop</label>
                            <div class="input-group">
                                <select id="shop" class="form-control mb-1" v-model="shop_value">
                                    <option v-for="shop_data in shop_select" v-bind:value="shop_data.id">{{ shop_data.shop_name }}</option>
                                </select>
                            </div>

                        <div class="container-fluid border-top p-0 pt-3 mt-2">
                            <div class="row">
                                <div class="col-6">
                                     <button class="btn btn-info" v-on:click="filterRecord"><i class="fas fa-sync-alt mr-2"></i>Filter</button>
                                </div>

                                <div class="col-6 text-right">
                                    <button class="btn btn-success mr-1" v-on:click="createRecord"><i class="fas fa-plus mr-2"></i>Add new Number</button>
                                    <button class="btn btn-light" v-on:click="downloadExcel"><i class="fas fa-print mr-2"></i>Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!--- table list --->

            <div class="main-content-table">
                <div class="row">
                    <div class="col-md-12">
                        <v-client-table
                            :data="stub_table_data"
                            :columns="columns"
                            :options="options">
                            <span slot="actions" slot-scope="{row}">
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

                            <div v-if="!count">
                                <h5 class="modal-title" v-if="adding">Generate Survey Number</h5>
                                <h5 class="modal-title" v-else>Edit City</h5>
                            </div>

                            <h5 class="modal-title" v-else>Total per city</h5>


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


                            <div v-if="count">
                                <v-client-table
                                    :data="number_table_data"
                                    :columns="columns_number"
                                    :options="options_number">
                                </v-client-table>
                            </div>


                            <div v-else>
                                <div class="form-group">
                                    <label for="number_of">How many survey number?</label>
                                    <input type="number" v-model="number_of_stub" id="number_of" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group" v-if="!count">
                                <button class="btn btn-success" v-if="adding" v-on:click="storeRecord">Submit</button>
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
            columns: ['survey_stub', 'voucher_code','city', 'actions'],
            stub_table_data: [],
            options: {
                headings: {
                    survey_stub: 'Survey Number',
                    voucher_code: 'Voucher Code',
                    city: 'City',
                    actions: 'Action'
                },
                sortable: ['survey_stub', 'voucher_code'],
                filterable: ['survey_stub', 'voucher_code'],
                texts : {
                    filter: 'Search:',
                },

            },

            columns_number: ['name', 'total_count'],
            number_table_data: [],
            options_number: {
                headings: {
                    name: 'City',
                    total_count: 'Total Survey Number',
                },
                sortable: ['name', 'total_count'],
                filterable: false,
                texts : {
                    filter: 'Search:',
                },

            },

            errors              :           [],
            city_select         :           [],
            shop_select         :           [],

            id                  :           null,
            err_msg             :           '',
            suc_msg             :           '',

            city_value          :           '',
            shop_value          :           '',
            number_of_stub      :           0,

            adding              :           true,
            count               :           true,
            err                 :           false,
            suc                 :           false,

        }
    },
    methods: {


        errorHandler(errors){

                let error_handler = [];
                $.each(errors, function(key, value) {
                    error_handler.push(value);
                });
                return error_handler;

        },






        returnSuccess(response) {

                $('#create-modal').modal('hide');
                this.suc = true;
                this.suc_msg = response.data.message;

        },





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



        

        getShop(e) {

                this.shop_select = [];
                axios.get('survey_number/getshopdata/' + e.target.value)
                .then(response => {
                    this.shop_select = response.data.shops
                })

        },




        closeMessageBox() {

                this.err = false;
                this.suc = false;
                this.adding = false;
                this.count = false;
                this.err_msg = '';
                this.suc_msg = '';
                this.errors = [];
                this.initialData();

        },



        createRecord() {

                this.adding = true;
                this.count = false;
                $('#create-modal').modal('show');

        },




        viewTotalCount() {

                this.adding = false;
                this.count = true;
                $('#create-modal').modal('show');

        },



        filterRecord() {

                this.stub_table_data = [];
                axios.get('survey_number/filter/' + this.city_value + '/' + this.shop_value)
                .then(response => 
                {
                    if(response.data.stub_numbers.length === 0) 
                    {
                        this.err_msg = "This record has no survey number yet";
                        this.err = true;
                    } 
                    else 
                    {
                         this.stub_table_data = response.data.stub_numbers;
                    }
                })
           
        },



        storeRecord() {

                axios.post('survey_number/store', {
                    number_of_stub: this.number_of_stub,
                    city: this.city_value,
                    store: this.shop_value,
                })
                .then(response => {
                    this.returnSuccess(response);
                    this.filterRecord();
                })
                .catch(error => {
                    this.returnFailed(error);
                });

        },




        deleteRecord(id) {

                axios.get('survey_number/destroy/' + id)
                .then(response => {
                    this.returnSuccess(response);
                    this.filterRecord();
                })
                .catch(error => {
                    this.returnFailed(error);
                });

        },




        initialData() {

                this.city_select = [];
                axios.get('survey_number/getdata').then(response => {
                    this.city_select = response.data.cities;
                })

        },



        downloadExcel() {

            if(this.city_value === '') {
                this.err_msg = 'City value is required';
                this.err = true;
                return;
            }

            if(this.shop_value === '') {
                this.err_msg = 'Shop value is required';
                this.err = true;
                return;
            }

            window.location.href = 'survey_number/pdf/' + this.city_value + '/' + this.shop_value;
        }


    },

    mounted() {
        this.initialData();
    }
}
</script>
