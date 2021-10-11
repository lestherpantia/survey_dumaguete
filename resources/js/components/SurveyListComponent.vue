
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

            <div class="row align-items-center">
                <div class="title col-6">
                    Surveys
                </div>
                <div class="col-6 text-right">
                    <!--<button class="btn btn-info" v-on:click="createRecord">Add new City</button>-->
                </div>
            </div>

            <!--- table list --->


            <div class="main-content-table">
                <div class="row">
                    <div class="col-md-12">
                        <v-client-table
                            :data="survey_table_data"
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

                            <h5 class="modal-title" id="exampleModalLabel" v-if="adding">Add City</h5>
                            <h5 class="modal-title" id="exampleModalLabel" v-else>Edit City</h5>

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
                                <label for="city">City</label>
                                <input type="text" class="form-control" v-model="city">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <button class="btn btn-success" v-if="adding" v-on:click="storeRecord">Submit</button>
                                <button class="btn btn-success" v-else v-on:click="updateRecord">Submit</button>
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
            columns: ['survey_stub','voucher_code', 'city', 'created_at', 'name', 'occupation', 'date', 'age', 'email', 'mobile', 'transact_type', 'survey_q_1_1', 'survey_q_1_2', 'survey_q_2', 'survey_q_3', 'survey_q_4', 'survey_q_5', 'survey_q_6', 'survey_q_6_other'],
            survey_table_data: [],
            options: {
                headings: {

                    survey_stub: 'Stub Number',
                    voucher_code: 'Voucher Code',
                    city: 'City',
                    created_at: 'Survey Date',
                    name: 'Name',
                    occupation: 'Occupation',
                    date: 'Date',
                    age: 'Age',
                    email: 'Email',
                    mobile: 'Mobile',
                    transact_type: 'Transact Type',
                    survey_q_1_1: 'Survey Q 1',
                    survey_q_1_2: 'Survey Q 1 - 2',
                    survey_q_2: 'Survey Q 2',
                    survey_q_3: 'Survey Q 3',
                    survey_q_4: 'Survey Q 4',
                    survey_q_5: 'Survey Q 5',
                    survey_q_6: 'Survey Q 6',
                    survey_q_6_other: 'Survey Q Other',
                },
                sortable: ['survey_stub', 'name', 'occupation'],
                filterable: ['survey_stub', 'name', 'occupation'],
                templates: {
                    created_at: function(h, row) {
                        return row.created_at !== null ? moment(row.created_at).format('YYYY-MM-DD hh:mm:ss') : null;
                    },
                },
                texts : {
                    filter: 'Search:',
                },

            },

            errors: [],
            adding: true,
            number_of_stub: 0,
            city: null,
            id: null,
            err_msg: '',
            suc_msg: '',
            err: false,
            suc: false,
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

        clearInput() {

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

        closeMessageBox() {
            this.err = false;
            this.suc = false;
            this.adding = false;
            this.err_msg = '';
            this.suc_msg = '';
            this.errors = [];
            this.initialData();
        },

        createRecord() {
            this.adding = true;
            $('#create-modal').modal('show');
        },

        editRecord(id) {
            this.adding = false;
            axios.get('city/edit/' + id)
            .then(response => {
                this.city = response.data.city.name;
                this.id = response.data.city.id;
            });
             $('#create-modal').modal('show');
        },

        storeRecord() {
            axios.post('city/store', {
                name: this.city
            })
            .then(response => {
                this.returnSuccess(response);
            })
            .catch(error => {
                this.returnFailed(error);
            });
        },


        

        updateRecord() {
            axios.patch('city/update', {
                id: this.id,
                name: this.city
            })
            .then(response => {
                this.returnSuccess(response);
            })
            .catch(error => {
                this.returnFailed(error);
            });
        },




        deleteRecord(id) {
            let confirmBox = confirm("Do you really want to delete this record?");
                if(confirmBox === true)
                {
                    axios.get('city/destroy/' + id)
                    .then(response => {
                        this.returnSuccess(response);
                    })
                    .catch(error => {
                        this.returnFailed(error);
                    });
                }
        },

        initialData() {
            this.city_table_data = [];
            axios.get('survey_list/getdata').then(response => {
                this.survey_table_data = response.data.surveys;
            })
        },

    },

    mounted() {
        this.initialData();
    }
}
</script>
