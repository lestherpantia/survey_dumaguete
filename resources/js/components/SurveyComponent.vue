<style>

    .main-container {
        width: 100%;
        margin: 0;
        padding: 0 10px 80px 10px;
    }

    .main-container .title h3 {
        font-size: 20px;
        font-weight: bold;
    }

    .main-container .language .select {
        margin-bottom: 80px;
        font-size: 20px;
    }

    .main-container .language .language_selection .flag {
        width: 120px;
        height: 60px;
    }

    .main-container .language .language_selection .flag img {
        width: 100%;
    }

    .main-container .language .language_selection h3 {
        text-align: center;
        font-size: 15px;
    }

    .main-container .language,
    .main-container .personal_information,
    .main-container .transaction_type,
    .main-container .survey_questions, 
    .main-container .rewards {
       display: none;
    }

    /*#eng, #bis,*/
    /*.hidden-checkbox,*/
    /*.survey_questions_q_1,*/
    /*.survey_questions_q_2,*/
    /*.survey_questions_q_3,*/
    /*.survey_questions_q_4,*/
    /*.survey_questions_q_6,*/
    /*.survey_questions_q_7 {*/
    /*    display: none;*/
    /*}*/

    input[type="radio"] {
        display: none;
    }

    .questions:hover {
        /*background: #2ecc71;*/
        /*color: #fff;*/
        /*border: 1px solid #f5f6fa;*/
    }

    input[type='text'].invalid,
    input[type='number'].invalid,
    input[type='date'].invalid,
    textarea.invalid {
        border: 1px solid #e74c3c;
    }

    .err_message {
        display: none;
        color: red;
        font-weight: bold;
    }

    .check-box {
        width: 20px;
        height: 20px;
        border: 1px solid #000;
        border-radius: 50%;
        padding: 2px;
    }

    .check-box .check-box-active {
        display: none;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: #2ecc71;
    }

    .others {
        display: none;
    }

    .check-box-data-privacy {
        width: 20px;
        height: 20px;
        border: 1px solid #000;
        border-radius: 3px;
    }

    .data-privacy-checkbox input[type="checkbox"] {
        display: none;
    }

    .check-box-data-privacy i {
        display: none;
        margin-left: 1px;
        font-size: 15px;
        color: #27ae60;
    }

    label {
        font-weight: normal !important;
    }

    .messagebox {
        z-index: 500;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(52, 73, 94, 0.4);
    }

    .message-box-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        padding: 50px;
        background: rgba(236, 240, 241,1.0);
    }

    .message-box-header {
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(189, 195, 199,1.0);
    }

    .message-box-body {
        padding: 50px 0;
    }

    .message-box-footer {
        padding-top: 10px;
        border-top: 1px solid rgba(189, 195, 199,1.0);
    }

    .message-box-footer button {
        float: right;
    }

    @media all and (max-width: 700px) {
        .message-box-content {
            width: 90%;
        }
    }

    .voucher {
        position: relative;
    }

    .modal-body {
        position: relative;
    }

    .modal-body img {
        width: 100%;
    }

    .voucher {
        position:absolute; 
        width: 70%;
        top: 230px;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .voucher .voucher_code {
        color: #fff;
        font-weight: bold;
        font-size: 25px;
        padding: 10px;
        border: 3px dashed #fff;
    }

    .voucher .shop_name {
        color: #fff;
        font-weight: bold;
        font-size: 30px;
    }

    .voucher .shop_address {
        color: #fff;
        font-weight: bold;
        font-size: 13px;
    }


    .close_survey {
        width: 100%;
        text-align: center;
        padding: 5px;
        font-size: 15px;
    }

    #other_answer {
        display: none;
        width: 100%;
    }

</style>


<template>

    <div class="main-container">

        <div style="position: absolute; top: 0; left: 0; z-index: 1000; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.2);" v-if="loader">
            <div style="position: fixed; top: 450px; left: 55%; transform:translate(-50%, -70%)">
                <img src="public/loader/loader.gif" alt="loader">
            </div>
        </div>


        <div class="messagebox" v-if="messagebox">
            <div class="message-box-content">
                <div class="message-box-header">
                    Message
                </div>

                <div class="message-box-body">
                    {{ message }}
                </div>

                <div class="message-box-footer">
                    <button class="btn btn-info" v-on:click="closemessagebox">Close</button>
                </div>
            </div>
        </div>

        <div class="title" style="width: 100%; text-align: center">
            <h3 class="mt-2">Survey on Ease of Doing Transaction with your City / Municipal LGU</h3>
        </div>

        <!------ survey stub entry -------->

        <section class="survey_stub text-center mt-5">
            <div class="container d-flex justify-content-center">
                <div class="form-group col-12 col-sm-4">
                    <label for="stab">Please Enter Survey Number</label>
                    <input type="text" id="stab" class="form-control p-2 text-center" style="font-weight: bold" v-model="stub_number">
                    <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>
                    <span class="valid" style="color: #2ecc71; font-weight: bold; font-size: 13px"></span>
                    <button class="btn btn-info form-control mt-1" v-on:click="validate_stub_number">Verify Number</button>
                </div>
            </div>
        </section>


        <!------ language selection -------->

        <section class="language text-center mt-5">
            <h3 class="select">Select your Language</h3>
            <div class="language_selection container">
                <div class="row d-flex justify-content-between">
                    <div class="col-5 d-flex justify-content-end align-items-center">
                        <label for="eng">
                            <div class="flag">
                                <input type="radio" name="language_select" id="eng" v-on:change="language_selection">
                                <img src="public/image/icons/english_flag.png" alt="">
                                <h3 class="mt-3">English</h3>
                            </div>
                        </label>
                    </div>

                    <div class="col-5 d-flex justify-content-start align-items-center">
                        <label for="bis">
                            <div class="flag">
                                <input type="radio" name="language_select" id="bis" v-on:change="language_selection">
                                <img src="public/image/icons/ph_flag.png" alt="">
                                <h3 class="mt-3">Bisaya</h3>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </section>


        <!------ personal information -------->


        <section class="personal_information mt-5">
            <div class="container d-flex justify-content-center">
                <div class="col-12 col-sm-8 col-lg-5 form-group">

                    <label for="name">1. Name (optional)<span style="color: red">*</span></label>
                    <input type="text" id="name" class="form-control" v-model="survey.name" placeholder="Last name, First name Middle name">

                    <div>
                        <label for="occupation" style="font-weight: normal">2. Occupation</label>
                        <!-- <input type="text" id="occupation" class="form-control" v-model="survey.occupation" required> -->
                        <select id="occupation" class="form-control" v-model="occupation" required>
                            <option value="pub_employee">Public Employee</option>
                            <option value="pri_employee">Private Employee</option>
                            <option value="biz_owner">Business Owner</option>
                            <option value="un_emp">Unemployed</option>
                            <option value="others">Others</option>
                        </select>
                        <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>

                    </div>

                    <div>
                        <label for="date">3. Date (mm/dd/yyyy)</label>
                        <input type="date" id="date" class="form-control" v-model="survey.date" required>
                        <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>
                    </div>

                    <div>
                        <label for="age">4. Age</label>
                        <input type="number" id="age" class="form-control" v-model="survey.age" required>
                        <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>
                    </div>

                    <label for="gender">5. Gender</label>
                    <select id="gender" class="form-control" v-model="gender">
                        <option>Male</option>
                        <option>Female</option>
                    </select>

                    <label for="email">6. Email Address (optional)<span style="color: red">*</span></label>
                    <input type="text" id="email" class="form-control" v-model="survey.email">

                    <label for="mobile">7. Mobile Number (optional)<span style="color: red">*</span></label>
                    <input type="text" id="mobile" class="form-control" v-model="survey.mobile">
                </div>
            </div>
        </section>


        <!---- transaction type ----->


        <section class="transaction_type mt-5">
            <div class="container d-flex justify-content-center">
                <div class="col-12 col-sm-8 col-lg-5 form-group">
                    <label v-if="language === 'bis'">1. Unsa na transaksyon sa LGU ang imong gi proceso?</label>
                    <label v-else>1. What type of transaction did you process?</label>

                    <div class="hidden-checkbox">
                        <input type="radio" name="transact_type_q" id="transact_type_q_1" v-on:change="checkbox" value="transact_1" v-model="survey.transact_type">
                        <input type="radio" name="transact_type_q" id="transact_type_q_2" v-on:change="checkbox" value="transact_2" v-model="survey.transact_type">
                        <input type="radio" name="transact_type_q" id="transact_type_q_3" v-on:change="checkbox" value="transact_3" v-model="survey.transact_type">
<!--                        <input type="radio" name="transact_type_q" id="transact_type_q_other" v-on:change="checkbox">-->

                        <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>

                        <label for="transact_type_q_1" style="width: 100%">
                            <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                <div class="transact_type_q_1 check-box active mr-3">
                                    <div class="check-box-active"></div>
                                </div>
                                Business Permit and Licensing
                            </div>
                        </label>

                        <label for="transact_type_q_2" style="width: 100%">
                            <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                <div class="check-box transact_type_q_2 mr-3">
                                    <div class="check-box-active"></div>
                                </div>
                                Real Property Tax Assessment (amilyar)
                            </div>
                        </label>

                        <label for="transact_type_q_3" style="width: 100%">
                            <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                <div class="check-box transact_type_q_3 mr-3">
                                    <div class="check-box-active"></div>
                                </div>
                                Issuance of Certificate
                            </div>
                        </label>

<!--                        <label for="transact_type_q_other" style="width: 100%">-->
<!--                            <div class="questions d-flex justify-content-start align-items-center p-2 rounded">-->
<!--                                <div class="check-box transact_type_q_other mr-3">-->
<!--                                    <div class="check-box-active"></div>-->
<!--                                </div>-->
<!--                                Others-->
<!--                            </div>-->
<!--                        </label>-->

<!--                        <div class="others">-->
<!--                            <label for="other_input">Please specify</label>-->
<!--                            <input type="text" id="other_input" class="form-control" v-model="others">-->
<!--                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>-->
<!--                        </div>-->

                    </div>

                </div>
            </div>
        </section>


        <!---- survey questions ------>

        <section class="survey_questions mt-5">
            <div class="container d-flex justify-content-center">
                <div class="form-group col-12 col-sm-8 col-lg-5">


                    <!---- survey question number 1 ------>


                    <div class="mb-5">

                        <label v-if="language === 'bis'">
                            2. Pila ka minutos o oras ka nahuman sa imong gipa proceso? <br>
                        </label>

                        <label v-else>
                            2. How many minutes/hours did it take to finish your transaction? <br>
                        </label>

                        <div class="survey_questions_q_1_1">

                            <input type="radio" name="survey_questions_q_1_1" id="survey_questions_q_1_1_1" v-on:change="checkbox" value="survey_q_1_1_1" v-model="survey.survey_q_1_1">
                            <input type="radio" name="survey_questions_q_1_1" id="survey_questions_q_1_1_2" v-on:change="checkbox" value="survey_q_1_1_2" v-model="survey.survey_q_1_1">
                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>

                            <label for="survey_questions_q_1_1_1" style="width: 100%">
                                <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                <div class="check-box survey_questions_q_1_1_1 mr-3">
                                        <div class="check-box-active"></div>
                                    </div>
                                    Less than 30 minutes
                                </div>
                            </label>

                            <label for="survey_questions_q_1_1_2" style="width: 100%">
                                <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                    <div class="check-box survey_questions_q_1_1_2 mr-3">
                                        <div class="check-box-active"></div>
                                    </div>
                                    More than an hour
                                </div>
                            </label>
                            
                        </div>

                        <label v-if="language === 'bis'">
                            Ug ika pila ka ga balik mi aning transakyon usa nimo nahuman? <br>
                        </label>

                        <label v-else>
                            And how many times did it take for your to go  back to the City / Municipal office/s to complete your transaction? <br>
                        </label>

                        <div class="survey_questions_q_1_2">

                            <input type="radio" name="survey_questions_q_1_2" id="survey_questions_q_1_2_1" v-on:change="checkbox" value="survey_q_1_2_1" v-model="survey.survey_q_1_2">
                            <input type="radio" name="survey_questions_q_1_2" id="survey_questions_q_1_2_2" v-on:change="checkbox" value="survey_q_1_2_2" v-model="survey.survey_q_1_2">
                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>

                            <label for="survey_questions_q_1_2_1" style="width: 100%">
                                <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                    <div class="check-box survey_questions_q_1_2_1 mr-3">
                                        <div class="check-box-active"></div>
                                    </div>
                                    Once
                                </div>
                            </label>

                            <label for="survey_questions_q_1_2_2" style="width: 100%">
                                <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                    <div class="check-box survey_questions_q_1_2_2 mr-3">
                                        <div class="check-box-active"></div>
                                    </div>
                                    More than once
                                </div>
                            </label>
                        </div>


                        <label class="mt-4 mb-2" style="font-weight: bold !important;">
                            Kindly place a check mark to your answer. <br>
                            Excellent - 5
                            <span style="color: #686de0;">4</span>
                            <span style="color: #f9ca24;">3</span>
                            <span style="color: #ff6b6b;">2</span>
                            <span style="color: #d63031;">1 - Low</span>
                        </label>

                    </div>


                    <!---- survey question number 2 ------>


                    <div class="mb-5">

                        <label v-if="language === 'bis'">
                            3. Para sa imo, hapsay ba ang proceso <br>
                            (pag sulat sa form, pag bayad, ug pag kuha sa dokumento ug resibo) ni ani?
                        </label>

                        <label v-else>
                            3. How convenient and efficient the transaction process <br>
                            (filling in of form, payment, release of docs and issuance of receipts) for you?
                        </label>

                        <div class="survey_questions_q_2">
                            <input type="radio" name="survey_questions_q_2" id="survey_questions_q_2_1" v-on:change="checkbox" value="survey_q_2_1" v-model="survey.survey_q_2">
                            <input type="radio" name="survey_questions_q_2" id="survey_questions_q_2_2" v-on:change="checkbox" value="survey_q_2_2" v-model="survey.survey_q_2">
                            <input type="radio" name="survey_questions_q_2" id="survey_questions_q_2_3" v-on:change="checkbox" value="survey_q_2_3" v-model="survey.survey_q_2">
                            <input type="radio" name="survey_questions_q_2" id="survey_questions_q_2_4" v-on:change="checkbox" value="survey_q_2_4" v-model="survey.survey_q_2">
                            <input type="radio" name="survey_questions_q_2" id="survey_questions_q_2_5" v-on:change="checkbox" value="survey_q_2_5" v-model="survey.survey_q_2">

                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>

                            <div class="d-flex justify-content-between">
                                <label for="survey_questions_q_2_1" class="text-center">
                                    1
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_2_1">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>

                                <label for="survey_questions_q_2_2" class="text-center">
                                    2
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_2_2">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>

                                <label for="survey_questions_q_2_3" class="text-center">
                                    3
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_2_3">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>

                                <label for="survey_questions_q_2_4" class="text-center">
                                    4
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_2_4">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>

                                <label for="survey_questions_q_2_5" class="text-center">
                                    5
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_2_5">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>


                    <!---- survey question number 3 ------>


                    <div class="mb-5">

                        <label v-if="language === 'bis'">
                            4. Unsay imong ika sulti gamit ang numero basi sa serbisyo na gihatag<br>
                            ni aning Suidad or Munisipyo?
                        </label>
                        <label v-else>
                            4. How do you find the services provided by the City / Municipality?
                        </label>

                        <div class="survey_questions_q_3">
                            <input type="radio" name="survey_questions_q_3" id="survey_questions_q_3_1" v-on:change="checkbox" value="survey_q_3_1" v-model="survey.survey_q_3">
                            <input type="radio" name="survey_questions_q_3" id="survey_questions_q_3_2" v-on:change="checkbox" value="survey_q_3_2" v-model="survey.survey_q_3">
                            <input type="radio" name="survey_questions_q_3" id="survey_questions_q_3_3" v-on:change="checkbox" value="survey_q_3_3" v-model="survey.survey_q_3">
                            <input type="radio" name="survey_questions_q_3" id="survey_questions_q_3_4" v-on:change="checkbox" value="survey_q_3_4" v-model="survey.survey_q_3">
                            <input type="radio" name="survey_questions_q_3" id="survey_questions_q_3_5" v-on:change="checkbox" value="survey_q_3_5" v-model="survey.survey_q_3">
                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>


                            <div class="d-flex justify-content-between">
                                <label for="survey_questions_q_3_1" class="text-center">
                                    1
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_3_1">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>

                                <label for="survey_questions_q_3_2" class="text-center">
                                    2
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_3_2">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>

                                <label for="survey_questions_q_3_3" class="text-center">
                                    3
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_3_3">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>

                                <label for="survey_questions_q_3_4" class="text-center">
                                    4
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_3_4">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>

                                <label for="survey_questions_q_3_5" class="text-center">
                                    5
                                    <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                        <div class="check-box survey_questions_q_3_5">
                                            <div class="check-box-active"></div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                        </div>

                    </div>


                    <!---- survey question number 4 ------>

                    <div class="mb-5">

                        <label v-if="language === 'bis'">
                            5. Para mas ma serbisyohan pa ug maayo, ganahan mi makabalo sa imong ideya kun unsa pay dapat buhaton kabahin ni aning mga facilidad ug serbisyo.
                        </label>
                        <label v-else>
                            5. We want to know your thoughts on how to improve our facilities and services to serve you better. Please write it on the box provided.
                        </label>

                        <textarea style="width: 100%" class="p-3" id="survey_questions_q_box" v-model="survey.survey_q_4"></textarea>
                        <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>

                    </div>


                    <!---- survey question number 5 ------>


                    <div class="mb-5">

                        <label v-if="language === 'bis'">
                            6. Lagmit abre baka sa ideya na naay 'Online Platform System' na puede maka transak?
                            ug ika pila sama sa mga dokumento o ug unsa man imong kinahanglan i.proceso ni
                            aning Syudad or Munisipyo para ma minusan imong oras ug mas makapadali sa ni aning
                            mga transakyon?
                        </label>
                        <label v-else>
                            6. Are you open to the idea of an ‘Online Platform System’ that you can do multiple transactions and payments at once to facilitate the effort and time spent on the City / Town LGU?
                        </label>

                        <div class="survey_questions_q_5">
                            <input type="radio" name="survey_questions_q_5" id="survey_questions_q_5_1" v-on:change="checkbox" value="survey_q_5_1" v-model="survey.survey_q_5">
                            <input type="radio" name="survey_questions_q_5" id="survey_questions_q_5_2" v-on:change="checkbox" value="survey_q_5_2" v-model="survey.survey_q_5">
                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>


                            <label for="survey_questions_q_5_1" style="width: 100%">
                                <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                    <div class="check-box survey_questions_q_5_1 mr-3">
                                        <div class="check-box-active"></div>
                                    </div>
                                    Yes
                                </div>
                            </label>

                            <label for="survey_questions_q_5_2" style="width: 100%">
                                <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                    <div class="check-box survey_questions_q_5_2 mr-3">
                                        <div class="check-box-active"></div>
                                    </div>
                                    No
                                </div>
                            </label>
                        </div>
                    </div>


                    <!---- survey question number 6 ------>


                    <div class="mb-5">

                        <label v-if="language === 'bis'">
                            7. Sama sa 'Online Platform System', okay ra ba nimo ug naay patong na 'transaction fee' ni ani?
                        </label>
                        <label v-else>
                            7. Is it acceptable for you to add a convenience fee on top of the transaction fees?
                        </label>

                        <div class="survey_questions_q_6">
                            <input type="radio" name="survey_questions_q_6" id="survey_questions_q_6_1" v-on:change="checkbox" value="survey_q_6_1" v-model="survey.survey_q_6">
                            <input type="radio" name="survey_questions_q_6" id="survey_questions_q_6_2" v-on:change="checkbox" value="survey_q_6_2" v-model="survey.survey_q_6">
                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>

                            <label for="survey_questions_q_6_1" style="width: 100%">
                                <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                    <div class="check-box survey_questions_q_6_1 mr-3">
                                        <div class="check-box-active"></div>
                                    </div>
                                    Yes
                                </div>
                            </label>

                            <label for="survey_questions_q_6_2" style="width: 100%">
                                <div class="questions d-flex justify-content-start align-items-center p-2 rounded">
                                    <div class="check-box survey_questions_q_6_2 mr-3">
                                        <div class="check-box-active"></div>
                                    </div>
                                    No
                                </div>
                            </label>
                        </div>

                        <div id="other_answer">
                            <textarea style="width: 100%" class="p-3" placeholder="Reason" id="other_answer_text" v-model="other_answer"></textarea>
                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>
                        </div>


                    </div>


                    <!---- data privacy act ------>


                    <div class="mb-5 container-fluid">
                        <div class="data-privacy-checkbox">
                            <input type="checkbox" id="data-privacy" v-on:change="dataprivacycheck" v-model="survey.data_privacy">
                            <span class="err" style="color: red; font-weight: bold; font-size: 13px"></span>
                        </div>

                        <div class="row">
                            <div class="col-1">
                                <label for="data-privacy">
                                    <div class="check-box-data-privacy d-flex align-items-center" style="margin-top: 2px">
                                        <i id="check" class="fas fa-check"></i>
                                    </div>
                                </label>
                            </div>

                            <div class="col-11">
                                <p style="font-size: 12px">
                                    By checking this box, I consent that the entity who conducted this survey may consume the information
                                    provided in whatever business or legal purpose it may serve under the compliance and protection of the
                                    Data Privacy Act of the Philippines.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="rewards mt-5">
            <div class="container text-center">
                <h4>Thank you for answering this survey!</h4>
                <div class="btn btn-info mt-1" v-on:click="showVoucher">Claim your reward!</div> 
            </div>
        </section>


        <!------ user button -------->


        <section v-if="page !== 0 && page !== 1 && page !== 5" class="user-button d-flex justify-content-center">
            <div class="col-12 col-sm-8 col-lg-5 form-group text-center">
                <button v-if="page > 2" class="btn btn-light mr-3" v-on:click="previous">Back</button>
                <button v-if="page !== 4" class="btn btn-success ml-3" v-on:click="next">Next<i class="ml-3 fas fa-angle-right"></i></button>
                <button v-else class="btn btn-success ml-3" v-on:click="submit" id="submit">Submit <i class="ml-3 fas fa-angle-right"></i></button>
            </div>
        </section>


        <!---- modal ---->


       <div class="modal fade" id="voucher-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body p-1" style="overflow: hidden;">
                        <img src="public/image/voucher/voucher.jpg"></img>

                        <div class="voucher text-center">
                            <div class="shop_name">{{ voucher_details.shop_name }}</div>
                            <div class="voucher_code">{{ voucher_details.voucher_code }}</div>
                            <span style="font-size: 12px; font-weight: bold; color: #fff">Store address</span>
                            <div class="shop_address">{{ voucher_details.shop_address }}</div>
                        </div>
                        <button class="close_survey btn btn-info" v-on:click="closeSurvey">
                            <i class="fas fa-check mr-3"></i> Finish Survey
                        </button>
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
            pages : ['survey_stub', 'language', 'personal_information', 'transaction_type', 'survey_questions', 'rewards'],
            survey: [],
            gender: 'Male',
            occupation: 'pub_employee',
            others: null,
            language: null,
            messagebox: false,
            message: [],
            page: 0,
            stub_number: null,
            loader: false,
            voucher_details: [],
            other_answer: '',

        }
    },

    methods: {

    
        currentdate() {
            const current = new Date();
            const date = `${current.getMonth()+1}/${current.getDate()}/${current.getFullYear()}`;
            return date;
        },

        language_selection(e) {
            this.language = e.target.id;
            this.next();
        },

        closemessagebox() {
            this.messagebox = false;
        },

        next() {
            if(this.validations(this.pages[this.page]) !== false) {
                this.page++;
                $("." + this.pages[this.page-1]).hide();
                $("." + this.pages[this.page]).show();
            }
        },

        previous() {
            this.page--;
            $("." + this.pages[this.page+1]).hide();
            $("." + this.pages[this.page]).show();
        },

        checkbox(e) {
            const element_id = e.target.id;
            const parent_class = $("#" + element_id).parent().attr("class");


            $("." + element_id + " .check-box-active").show();
            $("." + parent_class).children().each(function(){
                if($(this).attr('id') !== element_id) {
                    $("." + $(this).attr('id') + " .check-box-active").hide();
                }
            });


            if(element_id === 'survey_questions_q_6_2') {
                $('#other_answer').show();
            }
            else if(element_id === 'survey_questions_q_6_1') {
                $('#other_answer').hide();
                this.other_answer = '';
            }
           
        },

        dataprivacycheck(e) {
            if(e.target.checked) {
                $('#check').show();
                return
            }

            $('#check').hide();
        },

        validate_stub_number() {

            $('.survey_stub .err').text('');
            $('.survey_stub .valid').text('');

            if(this.stub_number === null || this.stub_number === '') {
                $('.survey_stub .err').text('Survey number is required');
                return;
            }

            axios.get('survey/check/' + this.stub_number)
            .then(
                response => {

                    if(response.data.used === 1) {
                        $('.survey_stub .err').text('This code is already used!');
                    }

                    if(response.data.valid === 0)
                    {
                        $('.survey_stub .err').text('This code is not valid!');
                    }

                    if($('.survey_stub .err').text().length === 0) {
                        this.next();
                        this.voucher_details = response.data.voucher_details;
                    }
                }
            );

        },

        validations(form) {

            let proceed = true;

            if(this.page > 1) {


                /* for input text validations */


                $("." + form).find('input').each( function() {
                    const element = this;
                    let str = element.id.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });

                    $("#" + element.id).removeClass('invalid').siblings('.err').html('');
                    if($("#" + element.id).prop('required') && element.value === '') {
                        $("#" + element.id).addClass('invalid').siblings('.err').html(str + ' is Required');
                        proceed = false;
                    }
                });

                if(form === 'transaction_type') {
                    $('.transaction_type .err').text('');
                    if($('input[name=transact_type_q]:checked').length === 0) {
                        $('.transaction_type .err').text('Please select your answer');
                        proceed = false;
                    }

                    if($('input[id=transact_type_q_other]:checked').length > 0) {
                        $('#other_input').addClass('invalid').siblings('.err').html('');
                        $('#other_input').removeClass('invalid');
                        if($('#other_input').val() === '') {
                            $('#other_input').addClass('invalid').siblings('.err').html('Input is required');
                            proceed = false;
                        }
                    }
                }

                if(form === 'survey_questions') {

                    $('.survey_questions_q_1_1 .err').text('');
                    if($('input[name=survey_questions_q_1_1]:checked').length === 0) {
                        $('.survey_questions_q_1_1 .err').text('Please select your answer');
                        proceed = false;
                    }

                    $('.survey_questions_q_1_2 .err').text('');
                    if($('input[name=survey_questions_q_1_2]:checked').length === 0) {
                        $('.survey_questions_q_1_2 .err').text('Please select your answer');
                        proceed = false;
                    }

                    $('.survey_questions_q_2 .err').text('');
                    if($('input[name=survey_questions_q_2]:checked').length === 0) {
                        $('.survey_questions_q_2 .err').text('Please select your answer');
                        proceed = false;
                    }

                    $('.survey_questions_q_3 .err').text('');
                    if($('input[name=survey_questions_q_3]:checked').length === 0) {
                        $('.survey_questions_q_3 .err').text('Please select your answer');
                        proceed = false;
                    }

                    $('.survey_questions_q_5 .err').text('');
                    if($('input[name=survey_questions_q_5]:checked').length === 0) {
                        $('.survey_questions_q_5 .err').text('Please select your answer');
                        proceed = false;
                    }

                    $('.survey_questions_q_6 .err').text('');
                    if($('input[name=survey_questions_q_6]:checked').length === 0) {
                        $('.survey_questions_q_6 .err').text('Please select your answer');
                        proceed = false;
                    }

                    $('#survey_questions_q_box').addClass('invalid').siblings('.err').html('');
                    $('#survey_questions_q_box').removeClass('invalid');
                    if($('#survey_questions_q_box').val() === '') {
                        $('#survey_questions_q_box').addClass('invalid').siblings('.err').html('This input is required');
                        proceed = false;
                    }   
                    
                    $('#other_answer_text').addClass('invalid').siblings('.err').html('');
                    $('#other_answer_text').removeClass('invalid');
                    if($('#survey_questions_q_6_2:checked').length === 1) {
                        if($('#other_answer_text').val() === '') {
                            $('#other_answer_text').addClass('invalid').siblings('.err').html('This input is required');
                            proceed = false;
                        }
                    }

                    $('.data-privacy-checkbox .err').text('');
                    if($('input[id="data-privacy"]:checked').length === 0) {
                        $('.data-privacy-checkbox .err').text('Please check the data privacy');
                        proceed = false;
                    }
                   
                }

            }

            return proceed;
        },


        submit() {
            if(this.validations(this.pages[this.page])) {
                $('#submit').attr('disabled', true);
                axios.post('survey/store', {
                    language                :           this.language,
                    stub_number             :           this.stub_number,
                    name                    :           this.survey.name,
                    occupation              :           this.occupation,
                    date                    :           this.survey.date,
                    age                     :           this.survey.age,
                    gender                  :           this.gender,
                    email                   :           this.survey.email,
                    mobile                  :           this.survey.mobile,
                    transact_type           :           this.survey.transact_type,
                    survey_q_1_1            :           this.survey.survey_q_1_1,
                    survey_q_1_2            :           this.survey.survey_q_1_2,
                    survey_q_2              :           this.survey.survey_q_2,
                    survey_q_3              :           this.survey.survey_q_3,
                    survey_q_4              :           this.survey.survey_q_4,
                    survey_q_5              :           this.survey.survey_q_5,
                    survey_q_6              :           this.survey.survey_q_6,
                    survey_q_6_other        :           this.other_answer,
                })
                .then(response => {
                    if(response.data.message === 'Success') {
                        this.next();
                    }
                })
            }
        },

        showVoucher() {
            $('#voucher-modal').modal('show');
        },

        closeSurvey() {
            window.location.href = "survey";
        }

    },

    mounted() {
        
    },

}
</script>

<style scoped>

</style>
