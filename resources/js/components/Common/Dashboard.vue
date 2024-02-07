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
                                                <!-- <option value="per_week">Per Week</option> -->
                                                <option value="per_month">Per Month</option>
                                                <option value="per_year">Per Year</option>
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
import VueApexCharts from 'vue-apexcharts'
export default {
    props: ['user'],
    components: { apexchart: VueApexCharts },
    data(){
        return {
            active_borrowers: 0,
            active_groups: 0,
            filter_type: 'per_month',
            year: new Date().getFullYear(),
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
            is_loading: false
        }
    },
    created() {
        this.commonRequest('/borrowers/active-counts','active_borrowers');
        this.commonRequest('/groupings/active-counts','active_groups');
        this.commonRequest(`/filter-loans/${this.year}/${this.filter_type}`,'total_loans',true,'computeMontlyLoans');
    },
    methods:{
        filterLoans(){
            let function_name = '';
            switch(this.filter_type) {
                case 'per_year':
                    let filter_years =  Array.from(new Array(12), (v, idx) => this.year + idx);
                    this.options.xaxis.categories = filter_years;
                    function_name = 'computeYearlyLoans';
                    break;
                case 'per_month':
                    this.options.xaxis.categories = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                    function_name = 'computeMontlyLoans';
                    break;
            }
            this.$refs.chart.refresh();
            this.commonRequest(`/filter-loans/${this.year}/${this.filter_type}`,'total_loans',true,function_name);
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
        computeMontlyLoans(loans){
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