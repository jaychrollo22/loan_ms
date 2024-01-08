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
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" v-if="id > 0 " @click="fetchCoBorrower">CO-BORROWER</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-documents" role="tab" aria-controls="pills-documents" aria-selected="false" v-if="id > 0 " @click="fetchDocuments">DOCUMENTS</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h1 class="card-title">BORROWER CONTACT INFORMATION</h1>
                                    </div>
                                    <div class="col-md-6" v-if="id > 0 ">
                                    <h1 class="card-title">{{ borrower.borrower_code }}</h1>
                                    </div>
                                </div>
                                <hr/>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Photo</label>
                                            <!-- <img class="rounded-circle" style='width:34px;height:34px;' :src="preview_image"/> -->
                                            <input type="file" class="form-control" name="profile_avatar" accept=".png, .jpg, .jpeg" ref="photo" @change="uploadPhoto($event,'borrower','Image')">
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
                                                @input="toggleSelected(borrower.borrower_type,'borrower','borrower_type_id')"
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
                                                @input="toggleSelected(borrower.country,'borrower','country_id','countries')"
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
                                                @input="toggleSelected(borrower.region,'borrower','region_id','regions')"
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
                                                @input="toggleSelected(borrower.county,'borrower','county_id','counties')"
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
                                                @input="toggleSelected(borrower.township,'borrower','township_id')"
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
                                                @input="toggleSelected(borrower.property_type,'borrower','property_type_id')"
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
                                                @input="toggleSelected(borrower.civil_status,'borrower','civil_status_id')"
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
                                                @input="toggleSelected(borrower.valid_id_type,'borrower','valid_id_type_id')"
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
                                                @input="toggleSelected(borrower.nature_of_business,'borrower','nature_of_business_id')"
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
                                                @input="toggleSelected(borrower.business_property_type,'borrower','business_property_type_id')"
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
                                <h1 class="card-title">CO-BORROWER CONTACT INFORMATION</h1>
                                <hr/>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">Photo</label>
                                            <!-- <img class="rounded-circle" style='width:34px;height:34px;' :src="preview_image"/> -->
                                            <input type="file" class="form-control" name="profile_avatar" accept=".png, .jpg, .jpeg" ref="photo" @change="uploadPhoto($event,'co_borrower','Image')">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Business Name</label>
                                            <input type="text" class="form-control" id="inputEmail4" placeholder="Business Name" v-model="co_borrower.business_name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">First Name</label>
                                            <input type="text" class="form-control" id="inputEmail4" placeholder="First Name" v-model="co_borrower.first_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPassword4">Middle Name</label>
                                            <input type="text" class="form-control" id="inputPassword4" placeholder="Middle Name" v-model="co_borrower.middle_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPassword4">Last Name</label>
                                            <input type="text" class="form-control" id="inputPassword4" placeholder="Last Name" v-model="co_borrower.last_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPassword4">Suffix</label>
                                            <input type="text" class="form-control" id="inputPassword4" placeholder="Suffix" v-model="co_borrower.suffix">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Country</label>
                                            <multiselect
                                                v-model="co_borrower.country"
                                                :options="countries"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel2"
                                                placeholder="Select Country"
                                                @input="toggleSelected(co_borrower.country,'co_borrower','country_id','countries')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputCity">Region</label>
                                            <multiselect
                                                v-model="co_borrower.region"
                                                :options="regions"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel2"
                                                placeholder="Select Region"
                                                @input="toggleSelected(co_borrower.region,'co_borrower','region_id','regions')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputCity">County</label>
                                            <multiselect
                                                v-model="co_borrower.county"
                                                :options="counties"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select County"
                                                @input="toggleSelected(co_borrower.county,'co_borrower','county_id','counties')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputCity">Township</label>
                                            <multiselect
                                                v-model="co_borrower.township"
                                                :options="townships"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Township"
                                                @input="toggleSelected(co_borrower.township,'co_borrower','township_id')"
                                            >
                                            </multiselect>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">City</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="City" v-model="co_borrower.city">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress2">Home Address</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="co_borrower.address">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Property Type</label>
                                            <multiselect
                                                v-model="co_borrower.property_type"
                                                :options="property_types"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Property Type"
                                                @input="toggleSelected(co_borrower.property_type,'co_borrower','property_type_id')"
                                            >
                                            </multiselect>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Age</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Age" v-model="co_borrower.age">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Civil Status</label>
                                            <multiselect
                                                v-model="co_borrower.civil_status"
                                                :options="civil_statuses"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Civil Status"
                                                @input="toggleSelected(co_borrower.civil_status,'co_borrower','civil_status_id')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Contact Number</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="co_borrower.contact_number">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Email Address</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Email Address" v-model="co_borrower.email_address">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Valid ID</label>
                                            <multiselect
                                                v-model="co_borrower.valid_id_type"
                                                :options="valid_id_types"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Valid ID Type"
                                                @input="toggleSelected(co_borrower.valid_id_type,'co_borrower','valid_id_type_id')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">ID Number</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="co_borrower.id_number">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Nature of Business</label>
                                            <multiselect
                                                v-model="co_borrower.nature_of_business"
                                                :options="nature_of_businesses"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Nature of Business"
                                                @input="toggleSelected(co_borrower.nature_of_business,'co_borrower','nature_of_business_id')"
                                            >
                                            </multiselect>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Business Property Type</label>
                                            <multiselect
                                                v-model="co_borrower.business_property_type"
                                                :options="property_types"
                                                :multiple="false"
                                                track-by="id"
                                                :custom-label="customLabel"
                                                placeholder="Select Property Type"
                                                @input="toggleSelected(co_borrower.business_property_type,'co_borrower','business_property_type_id')"
                                            >
                                            </multiselect>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress2">Business Address</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Address" v-model="co_borrower.business_address">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Monthly Sale</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Monthly Sale" v-model="co_borrower.monthly_sale">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputAddress2">Monthly Profit</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Monthly Profit" v-model="co_borrower.monthly_profit">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" @click="saveCoBorrower">Save</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab">
                                <p class="card-description">
                                    <button type="button" class="btn btn-outline-success btn-icon-text" data-toggle="modal" data-target="#uploadDocumentModal">
                                        <i class="ti-plus btn-icon-prepend"></i>                                                    
                                        New
                                    </button>
                                </p>
                            
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered tablewithSearch">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>File Name</th>
                                                <th>Date Uploaded</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(document, d) in documents" :key="d">
                                                <td>{{ document.id }}</td>
                                                <td>{{ document.title }}</td>
                                                <td><a :href="'../../storage/'+document.file_path" target="_blank" >{{ document.file_name }}</a></td>
                                                <td>{{ document.created_at }}</td>
                                                <td>
                                                    <button class="btn btn-danger" title="Delete Document" @click="deleteDocument(document.id,d)">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Start: Error Message-->
                    <error-messages :errors="errors" v-if="errors.length > 0"/>
                    <!-- End: Error Message -->
                </div>
            </div>
        </div>

        <div class="modal fade" id="uploadDocumentModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newLoanTypelabel">New Document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class='col-md-12 form-group'>
                                Title
                                <input type="text" name='name' class="form-control" required placeholder="Title" v-model="document.title">
                            </div>
                            <div class='col-md-12 form-group'>
                                Attach File
                                <input type="file" class="form-control" ref="photo" @change="uploadPhoto($event,'document','')">
                            </div>
                        </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" @click="saveDocument">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
import Multiselect from 'vue-multiselect'
export default {
    props: ['id'],
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
            co_borrower: {
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
            // preview_image: null,
            documents: [],
            document: {}
        }
    },
    created() {
        this.commonRequest('/borrower-types/lists','borrower_types');
        this.commonRequest('/countries/lists','countries');
        this.commonRequest('/civil-statuses/lists','civil_statuses');
        this.commonRequest('/valid-id-types/lists','valid_id_types');
        this.commonRequest('/nature-of-businesses/lists','nature_of_businesses');
        this.commonRequest('/property-types/lists','property_types');
        // if(this.id > 0) this.commonRequest('/borrowers/show/'+this.id,'borrower');
        if(this.id > 0) this.fetchBorrower();
    },
    methods:{
        customLabel (object) { return `${object.name}`},
        customLabel2 (object) { return `${object.code +' - '+ object.name}`},
        uploadPhoto(e,object,type){
            // const image = e.target.files[0];
            // const reader = new FileReader();
            // reader.readAsDataURL(image);
            // reader.onload = e =>{
            //     this.preview_image = e.target.result;
            //     console.log(this.preview_image);
            // };
            this[object].photo = '';
            if(type == 'Image' && /\.(jpe?g|png|gif)$/i.test(e.target.files[0].name) === false){
                alert('Please use Image file');
                this.$refs.photo.value = null;
                return false;
            }

            let files = e.target.files || e.dataTransfer.files;
            if(!files.length) return
            this[object].photo = files[0];
        },
        toggleSelected(value,object,model,fields = '') {
            this[object][model] = value.id;
            if(fields == 'countries') this.fetchRegions(object);
            if(fields == 'regions') this.fetchCounties(object);
            if(fields == 'counties') this.fetchTownships(object);
        },
        async fetchBorrower(){
            const response = await axios.get('/borrowers/show/'+this.id);
            this.borrower = response.data;
            this.fetchAddressDropDown('borrower');
        },
        fetchRegions(object){
            this.resetAddressParameters(this.regions,this[object].region,this[object].region_id);
            this.commonRequest(`/regions/lists/${this[object].country_id}`,'regions');
        },
        fetchCounties(object){
            this.resetAddressParameters(this.counties,this[object].county,this[object].county_id);
            this.commonRequest(`/counties/lists/${this[object].region_id}`,'counties');
        },
        fetchTownships(object){
            this.resetAddressParameters(this.townships,this[object].township,this[object].township_id);
            this.commonRequest(`/townships/lists/${this[object].region_id}/${this[object].county_id}`,'townships');
        },
        async fetchCoBorrower(){
            const response = await axios.get('/co-borrowers/show/'+this.id);
            this.co_borrower = response.data;
            this.fetchAddressDropDown('co_borrower');
        },
        fetchAddressDropDown(model){
            this.fetchRegions(model);
            this.fetchCounties(model);
            this.fetchTownships(model);
        },
        fetchDocuments(){
            this.commonRequest('/documents/lists/'+this.id,'documents');
        },
        resetAddressParameters(model1,model2,model3){
            model1 = [];
            model2 = '';
            model3 = '';
        },
        saveBorrower(){
            this.form_data.append('id', this.id);
            this.appendFormData(this.borrower);
            this.commonPostRequest('/borrowers/store');
        },
        saveCoBorrower(){
            this.form_data.append('borrower_id', this.id);
            this.appendFormData(this.co_borrower);
            this.commonPostRequest('/co-borrowers/store');
        },
        saveDocument(){
            this.form_data.append('borrower_id', this.id);
            this.appendFormData(this.document);
            this.commonPostRequest('/documents/store');
        },
        deleteDocument(id,index){
            axios.delete(`/documents/delete/${id}`)
            .then(response => { 
                this.documents.splice(index, 1);
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        },
        appendFormData(model){
            Object.entries(model).forEach(([key, value]) => {
                if(value && !['created_at','updated_at'].includes(key)) this.form_data.append(key, value);
            });
        },
        commonRequest(end_point,model){
            axios.get(end_point)
            .then(response => {
                this[model] = response.data;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            })
        },
        commonPostRequest(end_point){
            axios.post(end_point,this.form_data)
            .then(response => {
                window.location.href = '/borrowers/edit/'+ this.id ? this.id : response.data.id;
            })
            .catch(errors => {
                this.errors = Object.values(errors.response.data.errors);
            })
        }
    }
}
</script>