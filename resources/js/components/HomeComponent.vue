<template>

    <div class="container-fluid p-2">

        <div class="row p-3">
            <div class="col-12 ">
                 <h3 style="margin: 0px; font-weight: bold">Overview</h3>
            </div>

            <div class="col-12 text-right">
                <button class="btn btn-light" v-on:click="printDashboard"><i class="fas fa-print mr-3"></i>Print Dashboard</button>
            </div>
        </div>

       

        <div class="row">

            <div class="col-sm-12 col-md-9">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <select class="p-1 border rounded" v-model="city_value" v-on:change="onCityChange">
                                    <option v-for="data in city" v-bind:value="data.id">{{ data.name }}</option>
                                </select>
                            </div>

                            <div class="card-body container-fluid">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 text-center">
                                        <h4 style="font-size: 50px; font-weight: bold;" class="m-0">{{ top_data.from_count }}</h4>
                                        <span style="font-size: 20px; font-weight: bold;" class="m-0">Total Forms</span>
                                    </div>

                                    <div class="col-sm-12 col-md-4 text-center">
                                        <h4 style="font-size: 50px; font-weight: bold;" class="m-0">{{ top_data.forms_filled }}</h4>
                                        <span style="font-size: 20px; font-weight: bold;" class="m-0">Total Forms filled</span>
                                    </div>

                                    <div class="col-sm-12 col-md-4 text-center">
                                        <h4 style="font-size: 50px; font-weight: bold;" class="m-0">{{ top_data.forms_remaining }}</h4>
                                        <span style="font-size: 20px; font-weight: bold;" class="m-0">Remaining Forms</span>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <select class="p-1 border rounded" v-model="transact_type" v-on:change="onTransactionChange">
                                    <option value="transact_1">Business Permit and Licensing</option>
                                    <option value="transact_2">Real Property Tax Assessment</option>
                                    <option value="transact_3">Issuance of Certificate</option>
                                </select>
                            </div>
                            <div class="card-body container-fluid">
                               <div class="row">

                                    <!----- language ----->

                                    <div class="col-sm-12 col-md-3 p-3">

                                        <div class="col-12 pb-3 text-center text-bold">
                                            Language
                                        </div>

                                        <!---- english ----->

                                        <div class="form-group border-bottom">
                                            <div class="d-flex justify-content-between">
                                                <p>English</p>
                                                <p>{{ grouped.english }}</p>
                                            </div>
                                            
                                            <div class="line" style="height: 15px; width: 100%; background: rgba(229, 229, 229, 1)">
                                                <div v-bind:style="{ width: english_percentage + '%', height: '100%', backgroundColor: '#74b9ff' }"></div>
                                            </div>
                                        </div>

                                        <!---- bisaya ----->

                                        <div class="form-group border-bottom">
                                            <div class="d-flex justify-content-between">
                                                <p>Bisaya</p>
                                                <p>{{ grouped.bisaya }}</p>
                                            </div>

                                            <div class="line" style="height: 15px; width: 100%; background: rgba(229, 229, 229, 1)">
                                                <div v-bind:style="{ width: bisaya_percentage + '%', height: '100%', backgroundColor: '#ff7979' }"></div>
                                            </div>
                                        </div>
                                    </div>



                                    <!---- gender ----> 

                                    <div class="col-sm-12 col-md-3 p-3">

                                        <div class="col-12 pb-3 text-center text-bold">
                                            Gender
                                        </div>

                                        <!---- male ----->

                                        <div class="form-group border-bottom">
                                            <div class="d-flex justify-content-between">
                                                <p>Male</p>
                                                <p>{{ grouped.male }}</p>
                                            </div>
                                            
                                            <div class="line" style="height: 15px; width: 100%; background: rgba(229, 229, 229, 1)">
                                                <div v-bind:style="{ width: male_percentage + '%', height: '100%', backgroundColor: '#74b9ff' }"></div>
                                            </div>
                                        </div>

                                        <!---- female ----->

                                        <div class="form-group border-bottom">
                                            <div class="d-flex justify-content-between">
                                                <p>Female</p>
                                                <p>{{ grouped.female }}</p>
                                            </div>

                                            <div class="line" style="height: 15px; width: 100%; background: rgba(229, 229, 229, 1)">
                                                <div v-bind:style="{ width: female_percentage + '%', height: '100%', backgroundColor: '#ff7979' }"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <!---- age ----> 

                                    <div class="col-sm-12 col-md-3 p-3">

                                        <div class="col-12 pb-3 text-center text-bold">
                                            Age
                                        </div>

                                        <!---- adult ----->

                                        <div class="form-group border-bottom pt-2 pb-2">
                                            <div class="d-flex justify-content-between pr-3 pl-3">
                                                <p class="m-0">18 - 40</p>
                                                <p class="m-0">{{ this.grouped.adult }}</p>
                                            </div>
                                        </div>

                                        <!---- mid age ----->

                                        <div class="form-group border-bottom pt-2 pb-2">
                                            <div class="d-flex justify-content-between  pr-3 pl-3">
                                                <p class="m-0">41 - 60</p>
                                                <p class="m-0">{{ this.grouped.mid_age }}</p>
                                            </div>
                                        </div>

                                        <!---- senior ----->

                                        <div class="form-group border-bottom pt-2 pb-2">
                                            <div class="d-flex justify-content-between pr-3 pl-3">
                                                <p class="m-0">60 +</p>
                                                <p class="m-0">{{ this.grouped.senior }}</p>
                                            </div>
                                        </div>
                                    </div>


                                    <!---- occupation ----> 

                                    <div class="col-sm-12 col-md-3 colp-3">

                                        <div class="col-12 pb-3 text-center text-bold">
                                            Occupation
                                        </div>

                                        <!---- public employee ----->

                                        <div class="form-group border-bottom pt-2 pb-2">
                                            <div class="d-flex justify-content-between pr-3 pl-3">
                                                <p class="m-0">Public Employee</p>
                                                <p class="m-0">{{ this.grouped.public }}</p>
                                            </div>
                                        </div>

                                        <!---- private employee ----->

                                        <div class="form-group border-bottom pt-2 pb-2">
                                            <div class="d-flex justify-content-between pr-3 pl-3">
                                                <p class="m-0">Private Employee</p>
                                                <p class="m-0">{{ this.grouped.private }}</p>
                                            </div>
                                        </div>

                                        <!---- business owner ----->

                                        <div class="form-group border-bottom pt-2 pb-2">
                                            <div class="d-flex justify-content-between pr-3 pl-3">
                                                <p class="m-0">Business Owners</p>
                                                <p class="m-0">{{ this.grouped.biz_owner }}</p>
                                            </div>
                                        </div>

                                        <!---- unemployed ----->

                                        <div class="form-group border-bottom pt-2 pb-2">
                                            <div class="d-flex justify-content-between pr-3 pl-3">
                                                <p class="m-0">Unemployed</p>
                                                <p class="m-0">{{ this.grouped.un_emp }}</p>
                                            </div>
                                        </div>

                                         <!---- others ----->

                                        <div class="form-group border-bottom pt-2 pb-2">
                                            <div class="d-flex justify-content-between pr-3 pl-3">
                                                <p class="m-0">Others</p>
                                                <p class="m-0">{{ this.grouped.others }}</p>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <div class="card-body container-fluid">
                        <div class="row">

                            <div class="col-12 pt-5 pb-5">
                                <pie-chart 
                                    :colors="['#ff7979', '#686de0', '#ffbe76']" 
                                    :data="[['Business Permit and Licensing', grouped.biz_permit], ['Real Property Tax Assessment', grouped.real_property] , ['Issuance of Certificate', grouped.issuance_cert]]"
                                    >
                                </pie-chart>
                            </div>

                            <div class="form-group col-12 mt-5">
                                <div class="d-flex border-bottom justify-content-between p-2">
                                    <p class="m-0">Business Permit and Licensing</p>
                                    <p class="m-0">{{ grouped.biz_permit }}</p>
                                </div>

                                <div class="d-flex border-bottom justify-content-between p-2">
                                    <p class="m-0">Real Property Tax Assessment</p>
                                    <p class="m-0">{{ grouped.real_property }}</p>
                                </div>

                                <div class="d-flex border-bottom justify-content-between p-2">
                                    <p class="m-0">Issuance of Certificate</p>
                                    <p class="m-0">{{ grouped.issuance_cert }}</p>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>

            <div class="col-12">
                <div class="card">

                    <div class="card-body container-fluid">
                        <div class="row d-flex justify-content-between">

                            <div class="col-sm-12 col-md-3 p-2">
                                <div class="card-header text-center">
                                    Time to complete the transaction
                                </div>

                                <div class="card-body">
                                    <vc-donut :thickness="30" :size="250" unit="px" 
                                        :sections="[
                                            {value: grouped.survey_q_1_1_1, color: '#826af9'}, 
                                            {value: grouped.survey_q_1_1_2, color: '#2cd9c5'}]">
                                            <p style="margin: 0; font-size: 50px; font-weight: bold">{{ grouped.survey_count }}</p>
                                    </vc-donut>

                                    <div class="pr-1 pl-1 pt-5">
                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #826af9; padding: 2px"></div>
                                            <span>Less than 30 minutes : <span style="font-weight: bold">{{ grouped.survey_q_1_1_1 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #2cd9c5; padding: 2px"></div>
                                            <span>More than an hour : <span style="font-weight: bold">{{ grouped.survey_q_1_1_2 }}</span></span>
                                        </div> 
                                     </div>
                                </div>
                            </div>  

                            <div class="col-sm-12 col-md-3 p-2">
                                <div class="card-header text-center">
                                    Going back to complete the transaction
                                </div>

                                <div class="card-body">
                                    <vc-donut :thickness="30" :size="250" unit="px" 
                                        :sections="[
                                            {value: grouped.survey_q_1_2_1, color: '#826af9'}, 
                                            {value: grouped.survey_q_1_2_2, color: '#2cd9c5'}]">
                                            <p style="margin: 0; font-size: 50px; font-weight: bold">{{ grouped.survey_count }}</p>
                                    </vc-donut>

                                    <div class="pr-1 pl-1 pt-5">
                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #826af9; padding: 2px"></div>
                                            <span>Once : <span style="font-weight: bold">{{ grouped.survey_q_1_2_1 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #2cd9c5; padding: 2px"></div>
                                            <span>More than once : <span style="font-weight: bold">{{ grouped.survey_q_1_2_2 }}</span></span>
                                        </div>
                                     </div>
                                </div>
                            </div>  

                            <div class="col-sm-12 col-md-3 p-2">
                                <div class="card-header text-center">
                                    Conveniency and efficiency of transaction
                                </div>

                                <div class="card-body">
                                     <vc-donut :thickness="30" :size="250" unit="px" :sections="[
                                         {value: grouped.survey_q_2_1 , color: '#826af9' }, 
                                         {value: grouped.survey_q_2_2 , color: '#ffe700'} , 
                                         { value: grouped.survey_q_2_3 , color: '#2cd9c5'} , 
                                         { value:grouped.survey_q_2_4, color: '#2d99ff'} ,  
                                         {value:grouped.survey_q_2_5 , color: '#b64ee1'}]">
                                    <p style="margin: 0; font-size: 50px; font-weight: bold">{{ grouped.survey_count }}</p></vc-donut>

                                    <div class="pr-1 pl-1 pt-5">
                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #b64ee1; padding: 2px"></div>
                                            <span> Excellent : <span style="font-weight: bold">{{ grouped.survey_q_2_1 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #2d99ff; padding: 2px"></div>
                                            <span>Good : <span style="font-weight: bold">{{ grouped.survey_q_2_2 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #2cd9c5; padding: 2px"></div>
                                            <span>Average : <span style="font-weight: bold">{{ grouped.survey_q_2_3 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #ffe700; padding: 2px"></div>
                                            <span>Below Average : <span style="font-weight: bold">{{ grouped.survey_q_2_4 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #826af9; padding: 2px"></div>
                                            <span>Poor : <span style="font-weight: bold">{{ grouped.survey_q_2_5 }}</span></span>
                                        </div> 
                                    </div>
                                     
                                </div>
                            </div>  

                            <div class="col-sm-12 col-md-3 p-2">
                                <div class="card-header text-center">
                                    Rating of the services provided by city
                                </div>

                                <div class="card-body">
                                     <vc-donut :thickness="30" :size="250" unit="px" :sections="[
                                         {value: grouped.survey_q_3_1 , color: '#826af9' }, 
                                         {value: grouped.survey_q_3_2 , color: '#ffe700'}, 
                                         {value: grouped.survey_q_3_3 , color: '#2cd9c5'}, 
                                         {value:grouped.survey_q_3_4 , color: '#2d99ff'}, 
                                         {value:grouped.survey_q_3_5 , color: '#b64ee1'}]">
                                         <p style="margin: 0; font-size: 50px; font-weight: bold">{{ grouped.survey_count }}</p>
                                    </vc-donut>

                                    <div class="pr-1 pl-1 pt-5">
                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #b64ee1; padding: 2px"></div>
                                            <span>Excellent : <span style="font-weight: bold">{{ grouped.survey_q_3_1 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #2d99ff; padding: 2px"></div>
                                            <span>Good : <span style="font-weight: bold">{{ grouped.survey_q_3_2 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #2cd9c5; padding: 2px"></div>
                                            <span>Average : <span style="font-weight: bold">{{ grouped.survey_q_3_3 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #ffe700; padding: 2px"></div>
                                            <span>Below Average : <span style="font-weight: bold">{{ grouped.survey_q_3_4 }}</span></span>
                                        </div> 

                                        <div class="form-group d-flex justify-content-between pt-1 pb-1 pr-3 pl-3 border-bottom">
                                            <div style="width: 20px; height: 20px; border-radius: 50%; border: 5px solid #826af9; padding: 2px"></div>
                                            <span>Poor : <span style="font-weight: bold">{{ grouped.survey_q_3_5 }}</span></span>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top border-bottom pt-3 pb-3 mb-2 text-bold">
                            <p>5. Thoughts on how to improve facilities and services</p>
                            <button class="btn btn-light" v-on:click="printImprovement"><i class="fas fa-print mr-3"></i>Print Improvements</button>
                            <button class="btn btn-light" v-on:click="printTransactSurvey"><i class="fas fa-print mr-3"></i>Transaction Fee Survey</button>
                        </div>

                        <div class="row d-flex justify-content-center">

                            <div class="col-sm-12 col-md-3 mr-2 p-4">
                                <p>
                                    Idea of an Open Platform System that can do<br>
                                    multiple transaction and payments.
                                </p>

                                <pie-chart style="height: 250px;"
                                    :colors="['#75bbc8', '#16556f']" 
                                    :data="[['Yes', grouped.survey_q_5_1], ['No', grouped.survey_q_5_2]]">
                                </pie-chart>
                            </div>

                            <div class="col-sm-12 col-md-3 p-4">
                                <p>
                                   Acceptable for you to add a convenience fee on top<br>
                                   of the transaction fees.
                                </p>

                                <pie-chart style="height: 250px;"
                                    :colors="['#75bbc8', '#16556f']" 
                                    :data="[['Yes', grouped.survey_q_6_1], ['No', grouped.survey_q_6_2]]">
                                </pie-chart>
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
            test: '50',
            top_data: [],
            grouped: [],
            city: [],
            city_value: 0,
            english_percentage: 0,
            bisaya_percentage: 0,
            male_percentage: 0,
            female_percentage: 0,
            transact_type: 'transact_1',
        }
    },
    methods: { 

        onCityChange(e) {
           this.city_value = e.target.value;
           this.filterData(this.city_value, this.transact_type)
        },

       onTransactionChange(e) {
           this.transact_type = e.target.value;
           this.filterData(this.city_value, this.transact_type)
       },

       initialData() {
           axios.get('dashboard/getdata').then(response => {
               this.city = response.data.cities;
               this.city_value = response.data.cities[0].id;
               this.filterData(response.data.cities[0].id, 'transact_1');
           });
       },

       filterData(city, transact_type) 
       {
            this.english_percentage = 0;
            this.bisaya_percentage = 0;
            this.male_percentage = 0;
            this.female_percentage = 0;

            axios.get('dashboard/filter/' + city + '/' + transact_type)
            .then(response => {   
                    this.top_data = response.data.data;
                    this.grouped.survey_count = response.data.grouped.survey_count;
                    this.grouped.bisaya = response.data.grouped.bisaya;
                    this.grouped.english = response.data.grouped.english;
                    this.grouped.male = response.data.grouped.male;
                    this.grouped.female = response.data.grouped.female;
                    this.grouped.adult = response.data.grouped.adult;
                    this.grouped.mid_age = response.data.grouped.mid_age;
                    this.grouped.senior = response.data.grouped.senior;
                    this.grouped.biz_permit = response.data.grouped.biz_permit;
                    this.grouped.real_property = response.data.grouped.real_property;
                    this.grouped.issuance_cert = response.data.grouped.issuance_cert;
                    this.grouped.private = response.data.grouped.private;
                    this.grouped.public = response.data.grouped.public;
                    this.grouped.biz_owner = response.data.grouped.biz_owner;
                    this.grouped.un_emp = response.data.grouped.un_emp;
                    this.grouped.others = response.data.grouped.others;


                    /* survey answers */
                    this.grouped.survey_q_1_1_1 = response.data.grouped.survey_q_1_1_1;
                    this.grouped.survey_q_1_1_2 = response.data.grouped.survey_q_1_1_2;
                    this.grouped.survey_q_1_2_1 = response.data.grouped.survey_q_1_2_1;
                    this.grouped.survey_q_1_2_2 = response.data.grouped.survey_q_1_2_2;
                    this.grouped.survey_q_1_3 = response.data.grouped.survey_q_1_3;
                    this.grouped.survey_q_1_4 = response.data.grouped.survey_q_1_4;
                    this.grouped.survey_q_2_1 = response.data.grouped.survey_q_2_1;
                    this.grouped.survey_q_2_2 = response.data.grouped.survey_q_2_2;
                    this.grouped.survey_q_2_3 = response.data.grouped.survey_q_2_3;
                    this.grouped.survey_q_2_4 = response.data.grouped.survey_q_2_4;
                    this.grouped.survey_q_2_5 = response.data.grouped.survey_q_2_5;
                    this.grouped.survey_q_3_1 = response.data.grouped.survey_q_3_1;
                    this.grouped.survey_q_3_2 = response.data.grouped.survey_q_3_2;
                    this.grouped.survey_q_3_3 = response.data.grouped.survey_q_3_3;
                    this.grouped.survey_q_3_4 = response.data.grouped.survey_q_3_4;
                    this.grouped.survey_q_3_5 = response.data.grouped.survey_q_3_5;
                    this.grouped.survey_q_5_1 = response.data.grouped.survey_q_5_1;
                    this.grouped.survey_q_5_2 = response.data.grouped.survey_q_5_2;
                    this.grouped.survey_q_6_1 = response.data.grouped.survey_q_6_1;
                    this.grouped.survey_q_6_2 = response.data.grouped.survey_q_6_2;


                    /* compute percentage */
                    this.english_percentage = (response.data.grouped.english / response.data.grouped.survey_count) * 100;
                    this.bisaya_percentage = (response.data.grouped.bisaya / response.data.grouped.survey_count) * 100;
                    this.male_percentage = (response.data.grouped.male / response.data.grouped.survey_count) * 100;
                    this.female_percentage = (response.data.grouped.female / response.data.grouped.survey_count) * 100;
            });
        },    

        printImprovement() {
            window.location.href = 'dashboard/improvement';
        },

        printTransactSurvey() {
             window.location.href = 'dashboard/transact_survey';
        },
        
        printDashboard() {
            window.print();
        },

    },


    mounted() {
        this.initialData();
    }
}
</script>
