<style>

    .main-container {
        width: 100%;
        height: 100vh;
    }

    .main-container .card .card-header p,
    .main-container .card .card-header i {
        font-size: 19px;
        margin: 0;
    }

    .main-container .card .card-header p {
        text-align: right;
        font-weight: 600;
    }

    .main-container .card .card-header i {
        color: #2ecc71;
    }

    .main-container .card .card-footer {
        background: transparent;
        font-size: 13px;
    }

    .main-container .card .card-body #second_page, #third_page ,#forth_page {
        display: none;
    }

    .main-container .card .card-body #second_page, #third_page #other_input {
        display: none;
    }

    .main-container .card .card-body #third_page input[type="radio"] {
        display: none;
    }

    .main-container .card .card-body #third_page #bpl:checked ~ .bpl,
    .main-container .card .card-body #third_page #rpta:checked ~ .rpta,
    .main-container .card .card-body #third_page #ic:checked ~ .ic,
    .main-container .card .card-body #third_page #oth:checked ~ .oth {
        transition: ease-in 200ms;
        color: #fff;
        background: #00b894;
    }

    .main-container .card .card-body #forth_page input[type="radio"] {
        display: none;
    }

    .main-container .card .card-body #forth_page .q_1_1, .q_1_2, .q_1_3, .q_1_4, .q_2_1, .q_2_2, .q_2_3, .q_2_4, .q_2_5 {
        width: 100%;
        text-align: center;
    }

    .main-container .card .card-body #forth_page #q_1_1:checked ~ .container-fluid .row .col-12 .q_1_1,
    .main-container .card .card-body #forth_page #q_1_2:checked ~ .container-fluid .row .col-12 .q_1_2,
    .main-container .card .card-body #forth_page #q_1_3:checked ~ .container-fluid .row .col-12 .q_1_3,
    .main-container .card .card-body #forth_page #q_1_4:checked ~ .container-fluid .row .col-12 .q_1_4,
    .main-container .card .card-body #forth_page #q_2_1:checked ~ .container-fluid .row .col-12 .q_2_1,
    .main-container .card .card-body #forth_page #q_2_2:checked ~ .container-fluid .row .col-12 .q_2_2,
    .main-container .card .card-body #forth_page #q_2_3:checked ~ .container-fluid .row .col-12 .q_2_3,
    .main-container .card .card-body #forth_page #q_2_4:checked ~ .container-fluid .row .col-12 .q_2_4,
    .main-container .card .card-body #forth_page #q_2_5:checked ~ .container-fluid .row .col-12 .q_2_5
    {
        transition: ease-in 200ms;
        color: #fff;
        background: #00b894;
    }


</style>

<template>

    <div class="main-container d-flex align-items-center justify-content-center">
        <div class="card col-12 col-sm-6">
            <div class="card-header container-fluid">
                <div class="row align-items-center">
                    <div class="col-2 text-left">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="col-10 text-right">
                        <p>Survey on Ease of Doing Transaction With your City / Municipal LGU</p>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <!--       PAGE 1        -->

                <div id="first_page">
                    <label for="language">Please Select Language</label>
                    <select id="language" class="form-control">
                        <option value="1">Bisaya</option>
                        <option value="2">English</option>
                    </select>
                </div>


                <!--       PAGE 2         -->


                <div id="second_page">

                    <label for="name">Name (optional):</label>
                    <input type="text" class="form-control" id="name">

                    <label for="occupation">Occupation:</label>
                    <input type="text" class="form-control" id="occupation">

                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date">

                    <label for="age">Age:</label>
                    <input type="text" class="form-control" id="age">

                    <label for="gender">Gender:</label>
                    <select id="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Others</option>
                    </select>

                    <label for="email">Email Address (optional):</label>
                    <input type="text" class="form-control" id="email">

                    <label for="mobile">Mobile # (optional):</label>
                    <input type="text" class="form-control" id="mobile">

                </div>

                <!--       PAGE 3        -->

                <div id="third_page">
                    <input name="trans_type" id="bpl"  type="radio" v-on:change="hide_option">
                    <input name="trans_type" id="rpta" type="radio" v-on:change="hide_option">
                    <input name="trans_type" id="ic" type="radio" v-on:change="hide_option">
                    <input name="trans_type" id="oth" type="radio" v-on:change="other_option">


                    <h3 class="mb-3">What type of Transaction did you process?</h3>

                    <label style="width: 100%;" for="bpl" class="bpl p-3 border rounded">
                        Business Permit and Licensing
                    </label>

                    <label style="width: 100%;" for="rpta" class="rpta p-3 border rounded">
                        Real Property Tax Assessment
                    </label>

                    <label style="width: 100%;" for="ic" class="ic p-3 border rounded">
                        Issuance of Certificate
                    </label>

                    <label style="width: 100%;" for="oth" class="oth p-3 border rounded">
                        Others
                    </label>

                    <div id="other_input">
                        <label>Please Specified</label>
                        <input type="text" id="other" class="form-control" v-model="option_transaction">
                    </div>
                </div>

                <!--       PAGE 4        -->

                <div id="forth_page">
                    <input type="radio" name="question_1" id="q_1_1">
                    <input type="radio" name="question_1" id="q_1_2">
                    <input type="radio" name="question_1" id="q_1_3">
                    <input type="radio" name="question_1" id="q_1_4">

                    <label class="mb-4">
                        How many minutes/hours did it take to finish your transaction?
                        And how many times did it take for you to go back to the
                        City / Municipal office/s to complete your transaction?
                    </label>

                    <div class="container-fluid mb-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_1_1 p-2 border rounded" for="q_1_1">More than an Hour</label>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_1_2 p-2 border rounded" for="q_1_2">Less than 30 Minutes</label>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_1_3 p-2 border rounded" for="q_1_3">More than Once</label>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_1_4 p-2 border rounded" for="q_1_4">Once</label>
                            </div>
                        </div>
                    </div>

                    <input type="radio" name="question_2" id="q_2_1">
                    <input type="radio" name="question_2" id="q_2_2">
                    <input type="radio" name="question_2" id="q_2_3">
                    <input type="radio" name="question_2" id="q_2_4">
                    <input type="radio" name="question_2" id="q_2_5">

                    <label>
                        KINDLY PLACE A CHECK MARK TO YOUR ANSWER <br>
                        Excellent	–	5	4	3	2	1 	– 	Low
                    </label>

                    <label class="mb-4">
                        How convenient and efficient the transaction process (filling in of form, payment, release of docs and issuance of receipts) for you?
                    </label>

                    <div class="container-fluid mb-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_2_1 p-2 border rounded" for="q_2_1">5</label>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_2_2 p-2 border rounded" for="q_2_2">4</label>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_2_3 p-2 border rounded" for="q_2_3">3</label>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_2_4 p-2 border rounded" for="q_2_4">2</label>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="q_2_5 p-2 border rounded" for="q_2_5">1</label>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="d-flex justify-content-between">
                    <button class="btn btn-light mt-3 d-flex justify-content-between align-items-center" v-on:click="previous">
                        <i style="font-size: 30px" class="mr-3 fas fa-angle-left"></i>
                        Go Back
                    </button>

                    <button class="btn btn-info mt-3 d-flex justify-content-between align-items-center" v-on:click="next">
                        Proceed to Next Step
                        <i style="font-size: 30px" class="ml-3 fas fa-angle-right"></i>
                    </button>
                </div>

            </div>

            <div class="card-footer text-center text-muted">
                Copyright © 2021. Green Apple Technologies & Systems, Inc. All Rights Reserved.
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            steps: ['first_page', 'second_page', 'third_page', 'forth_page'],
            page: 1,
            option_transaction: null,
        }
    },

    methods: {

        next() {

            if(this.page > this.steps.length) {

            } else {
                $("#" + this.steps[this.page-1]).hide();
                $("#" + this.steps[this.page]).show();
                this.page++;
            }

        },

        previous() {

            if(this.page === 0) {

            } else {
                this.page++;
                $("#" + this.steps[this.page]).hide();
                $("#" + this.steps[this.page+1]).show();
            }

        },

        hide_option() {
            $('#other_input').hide();
            this.option_transaction = null;
        },

        other_option(e) {
            if(e.target.checked) {
                $('#other_input').show();
            }
        },


    },

    mounted() {

    }
}
</script>

<style scoped>

</style>
