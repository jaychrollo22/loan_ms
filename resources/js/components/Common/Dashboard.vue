<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Welcome {{ user }},</h3>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1>
                                        <a href='/borrowers/main'>{{ active_borrowers }}</a>
                                    </h1>
                                    <span>Active Borrowers</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1>
                                        <a href='/groupings/main'>{{ active_groups }}</a>
                                    </h1>
                                    <span>Active Groups</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="row ml-2 mt-2">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Filter By:</label>
                                            <select class="custom-select form-control-lg mt-2" v-model="filter_type">
                                                <option value="" disabled>Please Filter By</option>
                                                <option value="perWeek">Per Week</option>
                                                <option value="perMonth">Per Month</option>
                                                <option value="perYear">Per Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" v-if="filter_type == 'perWeek'">
                                        <div class="form-group">
                                            <label>Month</label>
                                            <select class="custom-select form-control-lg mt-2" v-model="month">
                                                <option value="" disabled>Please Select Month</option> 
                                                <option value="0">January</option>
                                                <option value="1">February</option>
                                                <option value="2">March</option>
                                                <option value="3">April</option>
                                                <option value="4">May</option>
                                                <option value="5">June</option>
                                                <option value="6">July</option>
                                                <option value="7">August</option>
                                                <option value="8">September</option>
                                                <option value="9">October</option>
                                                <option value="10">November</option>
                                                <option value="11">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <select class="custom-select form-control-lg mt-2" v-model="year">
                                                <option value="" disabled>Please Select Year</option> 
                                                <option v-for="(year, y) in populateYears" :value="year" :key="y">{{ year }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 pt-4">
                                        <button type="button" class="btn btn-primary" @click="filterLoans" :disabled="is_loading">Filter</button>
                                    </div>
                                </div>
                                <div class="row mt-3 ml-3 mr-1">
                                    <div class="col-md-12">
                                        <h5>Total Released Loans with Interest( {{ year }} )</h5>
                                    </div>
                                </div> 
                                <apexchart height="500" type="bar" ref="chart" :options="options" :series="series"></apexchart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts';
import moment from 'moment';
export default {
    props: ['user'],
    components: { apexchart: VueApexCharts },
    data(){
        return {
            active_borrowers: 0,
            active_groups: 0,
            filter_type: 'perMonth',
            year: new Date().getFullYear(),
            month: new Date().getMonth(),
            total_loans: 0,
            total_interest: 0,
            options: {
                chart: {
                    id: 'vuechart-example',
                    toolbar: {
                        show: false
                    }
                },
                xaxis: {
                    categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
                },
                dataLabels: {
                    enabled: false
                }
            },
            series: [{
                name: 'Loans',
                data: [0,0,0,0,0,0,0,0,0,0,0,0]
            },
            {
                name: 'Interest',
                data: [0,0,0,0,0,0,0,0,0,0,0,0]
            }],
            is_loading: false,
            week_start: 0,
            week_end: 0,
        }
    },
    created() {
        this.commonRequest('/borrowers/active-counts','active_borrowers');
        this.commonRequest('/groupings/active-counts','active_groups');
        this.commonRequest(`/filter-loans/${this.year}/${this.month}/${this.filter_type}`,'total_loans',true,'computeMonthlyLoans');
    },
    methods:{
        filterLoans(){
            let function_name = '';
            switch(this.filter_type) {
                case 'perWeek':
                    const firstDayOfMonth = new Date(this.year, this.month, 1);
                    const lastDayOfMonth = new Date(this.year,(parseFloat(this.month) + 1), 0);
                    const numberOfDaysInMonth = lastDayOfMonth.getDate();
                    const numberOfWeeks = Math.ceil((numberOfDaysInMonth + firstDayOfMonth.getDay()) / 7);
                
                    let counter = 1;
                    let weeks = [];
                    while(counter <= numberOfWeeks){
                        weeks.push('Week ' + counter);
                        counter++;
                    }
                    this.options.xaxis.categories = weeks;
                    function_name = 'computeWeeklyLoans';

                    const date = moment(this.year+'-'+(parseFloat(this.month) + 1)+'-01', 'YYYY-MM-DD');
                    this.week_start = date.isoWeek();
                    this.week_end = this.week_start + (numberOfWeeks - 1);    
                    break;
                case 'perYear':
                    let filter_years =  Array.from(new Array(12), (v, idx) => this.year + idx);
                    this.options.xaxis.categories = filter_years;
                    function_name = 'computeYearlyLoans';
                    break;
                case 'perMonth':
                    this.options.xaxis.categories = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                    function_name = 'computeMonthlyLoans';
                    break;
            }
            this.$refs.chart.refresh();
            this.commonRequest(`/filter-loans/${this.year}/${this.month}/${this.filter_type}`,'total_loans',true,function_name);
        },
        commonRequest(end_point,model,additional_logic = false,function_name = null){
            this.is_loading = true;
            axios.get(end_point)
            .then(response => {
                this[model] = response.data;
                if(additional_logic) this[function_name](this[model]);
                this.is_loading = false;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            })
        },
        computeWeeklyLoans(loans){
            let total_loans = [];
            let total_interest = [];
            let array_weeks = [];

            while(this.week_start <= this.week_end){
                array_weeks.push(this.week_start++);
            }

            array_weeks.filter((item,index) => {
                let week = loans.filter(loan => item == (loan.week + 1));
                let loan_amount = 0;
                let interest_amount = 0;
                if(week.length){
                    loan_amount = week[0].total_amount;
                    interest_amount = week[0].total_interest;
                }
                total_loans.push(loan_amount);
                total_interest.push(interest_amount);
            });
            this.updateComputation(total_loans,total_interest);
        },
        computeMonthlyLoans(loans){
            let total_loans = [];
            let total_interest = [];
            this.series[0].data.filter((item,index) => {
                let month = loans.filter(loan => index  == loan.month - 1);
                let loan_amount = 0;
                let interest_amount = 0;
                if(month.length){
                    loan_amount = month[0].total_amount;
                    interest_amount = month[0].total_interest;
                }
                total_loans.push(loan_amount);
                total_interest.push(interest_amount);
            });
            this.updateComputation(total_loans,total_interest);
        },
        computeYearlyLoans(loans){
            let total_loans = [];
            let total_interest = [];
            this.options.xaxis.categories.filter((item,index) => {
                let year = loans.filter(loan => item  == loan.year);
                let loan_amount = 0;
                let interest_amount = 0;
                if(year.length){
                    loan_amount = year[0].total_amount;
                    interest_amount = year[0].total_interest;
                }
                total_loans.push(loan_amount);
                total_interest.push(interest_amount);
            });
            this.updateComputation(total_loans,total_interest);
        },
        updateComputation(total_loans,total_interest){
            // In the same way, update the series option
            this.series = [
                { data: total_loans},
                { data: total_interest}    
            ];
        }
    },
    computed:{
        populateYears(){
            const year = 2024;
            return Array.from(new Array(20), (v, idx) => year + idx);
        }
    }
}
</script>   