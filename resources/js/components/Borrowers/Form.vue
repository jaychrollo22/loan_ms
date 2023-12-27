<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">BORROWER</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">CO-BORROWER</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <h1 class="card-title">CONTACT INFORMATION</h1>
                                <hr/>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Photo</label>
                                            <!-- <img class="rounded-circle" style='width:34px;height:34px;' :src="preview_image"/> -->
                                            <input type="file" class="form-control" name="profile_avatar" accept=".png, .jpg, .jpeg" ref="photo" @change="uploadPhoto">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Type</label>
                                            <multiselect
                                                v-model="borrower.borrower_type"
                                                :options="borrower_types"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Borrower Type"
                                                @input="toggleSelected(borrower.borrower_type,'borrower_type_id')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-6">
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
                                            <multiselect
                                                v-model="borrower.country"
                                                :options="countries"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel2"
                                                placeholder="Select Country"
                                                @input="toggleSelected(borrower.country,'country_id','countries')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputCity">Region</label>
                                            <multiselect
                                                v-model="borrower.region"
                                                :options="regions"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel2"
                                                placeholder="Select Region"
                                                @input="toggleSelected(borrower.region,'region_id','regions')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputCity">County</label>
                                            <multiselect
                                                v-model="borrower.county"
                                                :options="counties"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select County"
                                                @input="toggleSelected(borrower.county,'county_id','counties')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputCity">Township</label>
                                            <multiselect
                                                v-model="borrower.township"
                                                :options="townships"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Township"
                                                @input="toggleSelected(borrower.township,'township_id')"
                                            >
                                            </multiselect>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">City</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="City" v-model="borrower.city">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress2">Home Address</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="borrower.address">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Property Type</label>
                                            <multiselect
                                                v-model="borrower.property_type"
                                                :options="property_types"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Property Type"
                                                @input="toggleSelected(borrower.property_type,'property_type_id')"
                                            >
                                            </multiselect>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Age</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Age" v-model="borrower.age">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Civil Status</label>
                                            <multiselect
                                                v-model="borrower.civil_status"
                                                :options="civil_statuses"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Civil Status"
                                                @input="toggleSelected(borrower.civil_status,'civil_status_id')"
                                            >
                                            </multiselect>
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
                                            <multiselect
                                                v-model="borrower.valid_id_type"
                                                :options="valid_id_types"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Valid ID Type"
                                                @input="toggleSelected(borrower.valid_id_type,'valid_id_type_id')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">ID Number</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="borrower.id_number">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Nature of Business</label>
                                            <multiselect
                                                v-model="borrower.nature_of_business"
                                                :options="nature_of_businesses"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Nature of Business"
                                                @input="toggleSelected(borrower.nature_of_business,'nature_of_business_id')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Business Property Type</label>
                                            <multiselect
                                                v-model="borrower.business_property_type"
                                                :options="property_types"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Property Type"
                                                @input="toggleSelected(borrower.business_property_type,'business_property_type_id')"
                                            >
                                            </multiselect>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress2">Business Address</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="borrower.business_address">
                                        </div>
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
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                FOR DEVELOPMENT
                            </div>
                        </div>
                    </div>

                    <!-- Start: Error Message-->
                    <error-messages :errors="errors" v-if="errors.length > 0"/>
                    <!-- End: Error Message -->
                </div>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
    import Multiselect from 'vue-multiselect'
    export default {
        components: { Multiselect },
        data(){
            return {
                form_data: new FormData(),
                borrower: {
                    region: '',
                    region_id: '',
                    county: '',
                    county_id: '',
                    township: '',
                    township_id: ''
                },
                borrower_types: [],
                countries: [],
                regions: [],
                counties: [],
                townships: [],
                civil_statuses: [],
                valid_id_types: [],
                nature_of_businesses: [],
                property_types: [],
                errors: [],
                // preview_image: null
            }
        },
        created() {
            this.commonRequest('/borrower-types/lists','borrower_types');
            this.commonRequest('/countries/lists','countries');
            this.commonRequest('/civil-statuses/lists','civil_statuses');
            this.commonRequest('/valid-id-types/lists','valid_id_types');
            this.commonRequest('/nature-of-businesses/lists','nature_of_businesses');
            this.commonRequest('/property-types/lists','property_types');
        },
        methods:{
            customLabel (object) { return `${object.name}`},
            customLabel2 (object) { return `${object.code +' - '+ object.name}`},
            uploadPhoto(e){
                // const image = e.target.files[0];
                // const reader = new FileReader();
                // reader.readAsDataURL(image);
                // reader.onload = e =>{
                //     this.preview_image = e.target.result;
                //     console.log(this.preview_image);
                // };
                this.borrower.photo = '';
                if(/\.(jpe?g|png|gif)$/i.test(e.target.files[0].name) === false){
                    alert('Please use Image file');
                    this.$refs.photo.value = null;
                    return false;
                }

                let files = e.target.files || e.dataTransfer.files;
                if(!files.length) return
                this.borrower.photo = files[0];
            },
            toggleSelected(value,model,fields = '') {
                this.borrower[model] = value.id;
                if(fields == 'countries') this.fetchRegions();
                if(fields == 'regions') this.fetchCounties();
                if(fields == 'counties') this.fetchTownships();
			},
            fetchRegions(){
                this.regions = [];
                this.borrower.region = '';
                this.borrower.region_id = '';
                this.commonRequest(`/regions/lists/${this.borrower.country_id}`,'regions');
            },
            fetchCounties(){
                this.counties = [];
                this.borrower.county = '';
                this.borrower.county_id = '';
                this.commonRequest(`/counties/lists/${this.borrower.region_id}`,'counties');
            },
            fetchTownships(){
                this.townships = [];
                this.borrower.township = '';
                this.borrower.township_id = '';
                this.commonRequest(`/townships/lists/${this.borrower.region_id}/${this.borrower.county_id}`,'townships');
            },
            saveBorrower(){
                Object.entries(this.borrower).forEach(([key, value]) => {
                    this.form_data.append(key, value);
                });
                axios.post('/borrowers/store',this.form_data)
                .then(response => {
                    window.location.href = '/borrowers/main';
                })
                .catch(errors => {
                    this.errors = Object.values(errors.response.data.errors);
                })
            },
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