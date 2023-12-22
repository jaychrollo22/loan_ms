<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Borrower</h1>
                    <hr/>
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Type</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Type" v-model="borrower.borrower_type">
                            </div>
                            <div class="form-group col-md-9">
                                <label for="inputEmail4">Business Name</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Business Name" v-model="borrower.business_name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">First Name</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="First Name" v-model="borrower.first_name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Middle Name</label>
                                <input type="text" class="form-control" id="inputPassword4" placeholder="Middle Name" v-model="borrower.middle_name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Last Name</label>
                                <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" v-model="borrower.last_name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Suffix</label>
                                <input type="text" class="form-control" id="inputPassword4" placeholder="Suffix" v-model="borrower.suffix">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Country</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Country" v-model="borrower.country_id">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Region</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Region" v-model="borrower.region_id">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">County</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="County" v-model="borrower.county_id">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Township</label>
                                <input type="text" class="form-control" id="inputCity" placeholder="Township" v-model="borrower.township_id">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">City</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="City" v-model="borrower.city">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Address</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="borrower.address">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Property Type</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Property Type" v-model="borrower.property_type_id">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Age</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Age" v-model="borrower.age">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Civil Status</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Civil Status" v-model="borrower.civil_status_id">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Contact Number</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="borrower.contact_number">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Email Address</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Email Address" v-model="borrower.email_address">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Valid ID</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Valid ID" v-model="borrower.valid_id_type_id">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">ID Number</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="borrower.id_number">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Nature of Business</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Nature of Business" v-model="borrower.nature_of_business_id">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Propert Type</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Propert Type" v-model="borrower.property_type_id">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Monthly Sale</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Monthly Sale" v-model="borrower.monthly_sale">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Monthly Profit</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Monthly Profit" v-model="borrower.monthly_profit">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" @click="saveBorrower">Save</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                borrower: {},
                errors: []
            }
        },
        created() {
        //    this.fetchBorrowers();
        },
        methods:{
            saveBorrower(){
                axios.post('/borrowers/store',{
                    borrower: this.borrower
                })
                .then(response => {
                    window.location.href = '/borrowers/main';
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                })
            }
        }
    }
</script>