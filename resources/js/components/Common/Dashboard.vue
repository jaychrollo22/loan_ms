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
                                    <h1>{{ active_borrowers }}</h1>
                                    <span>Active Borrowers</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h1>{{ active_groups }}</h1>
                                    <span>Active Groups</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                         <div class="col-md-12">
                            <div class="card ">
                                <h5 class="mt-3 ml-3">Total Released Loans with Interest( {{ year }} )</h5>
                                <apexchart height="500" type="bar" :options="options" :series="series"></apexchart>
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
            year: new Date().getFullYear(),
            total_loans: 0,
            total_interest: 0,
            options: {
                chart: {
                    id: 'vuechart-example'
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
        }
    },
    created() {
        this.commonRequest('/borrowers/active-counts','active_borrowers');
        this.commonRequest('/groupings/active-counts','active_groups');
        this.commonRequest(`/total-loans/${this.year}`,'total_loans',true,'computeMontlyLoans');
    },
    methods:{
        commonRequest(end_point,model,additional_logic = false,function_name = null){
            axios.get(end_point)
            .then(response => {
                this[model] = response.data;
                if(additional_logic) this[function_name](this[model]);
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
            // In the same way, update the series option
            this.series = [
                { data: total_loans},
                { data: total_interest}    
            ];
        }
    }
}
</script>   