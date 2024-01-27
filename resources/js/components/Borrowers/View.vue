<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <div class="row">
                            <h3>BORROWER PROFILE</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-2 text-center">
                                <img :src="'../../storage/'+borrower.file_path" style="max-width:150px;min-height:150px;height:auto;">
                            </div>
                            <div class="col-md-10">
                                <h3>{{ borrower.first_name+' '+borrower.middle_name+' '+borrower.last_name }}</h3>
                                <span>
                                    {{ borrower.address+' '+borrower.city }}<br><br>

                                    Type : {{ borrower.borrower_type.name }}<br>
                                    <span v-if="borrower.borrower_type_id == 1">Loan Officer : {{ borrower.loan_officer.name }}<br></span>
                                    <span v-if="borrower.borrower_type_id == 2">Grouping : {{ borrower.grouping.name }}<br></span>
                                    Business Name : {{ borrower.business_name }}<br>
                                    Country : {{ borrower.country.name }}<br>
                                    Region : {{ borrower.region.name }}<br>
                                    County : {{ borrower.county.name }}<br>
                                    Township : {{ borrower.township.name }}<br>
                                    Age : {{ borrower.age }}<br>
                                    Civil Status : {{ borrower.civil_status.name }}<br>
                                    Contact Number : {{ borrower.contact_number }}<br>
                                    Email Address : {{ borrower.email_address }}<br>
                                    Valid ID : {{ borrower.valid_id_type.name }}<br>
                                    ID Number: {{ borrower.id_number }}<br>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2" v-if="co_borrower">
                        <div class="row">
                            <h3>CO-BORROWER PROFILE</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <img :src="'../../storage/'+co_borrower.file_path" style="max-width:150px;min-height:150px;height:auto;">
                            </div>
                            <div class="col-md-10">
                                <h3>{{ co_borrower.first_name+' '+co_borrower.middle_name+' '+co_borrower.last_name }}</h3>
                                <span>
                                    {{ co_borrower.address+' '+co_borrower.city }}<br><br>

                                    Business Name : {{ co_borrower.business_name }}<br>
                                    Country : {{ co_borrower.country.name }}<br>
                                    Region : {{ co_borrower.region.name }}<br>
                                    County : {{ co_borrower.county.name }}<br>
                                    Township : {{ co_borrower.township.name }}<br>
                                    Age : {{ co_borrower.age }}<br>
                                    Civil Status : {{ co_borrower.civil_status.name }}<br>
                                    Contact Number : {{ co_borrower.contact_number }}<br>
                                    Email Address : {{ co_borrower.email_address }}<br>
                                    Valid ID : {{ co_borrower.valid_id_type.name }}<br>
                                    ID Number: {{ co_borrower.id_number }}<br>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2" v-if="documents.length > 0">
                        <div class="row">
                            <h3>DOCUMENTS</h3>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered tablewithSearch">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>File Name</th>
                                            <th>Date Uploaded</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(document, d) in documents" :key="d">
                                            <td> {{ document.title }}</td>
                                            <td><a :href="'../../storage/'+document.file_path" target="_blank" >{{ document.file_name }}</a></td>
                                            <td>{{ document.created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
    props: ['id'],
    data(){
        return {
            borrower: {},
            co_borrower: {},
            documents: []
        }
    },
    created() {
        this.commonRequest('/borrowers/show/'+this.id,'borrower');
        this.commonRequest('/co-borrowers/show/'+this.id,'co_borrower');
        this.commonRequest('/documents/lists/'+this.id,'documents');
    },
    methods:{
        commonRequest(end_point,model){
            axios.get(end_point)
            .then(response => {
                this[model] = response.data;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            })
        }
    }
}
</script>