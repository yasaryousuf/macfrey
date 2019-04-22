@extends('admin.layouts.master') @section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
                <h4 class="card-title">Component form</h4>
                <p class="card-description">
                    Add component
                </p>
                <form action="{{url('component')}}" method="POST" name="create-component" enctype="multipart/form-data">
                    @csrf
                    <h4 style="margin-top:45px">Basic Information</h4> <hr>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Parent Category:</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="parent_id">
                            <option value="">Choose your option</option>
                            @foreach ($componentCategories as $componentCategory)
                                <option value="{{$componentCategory->id}}">{{$componentCategory->name}}</option>
                            @endforeach

                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Description</label>
                        <textarea class="form-control" placeholder="description" name="description" required></textarea>
                    </div>



                    <h4 style="margin-top:45px">Core Data</h4> <hr>
                    <div class="form-group">
                        <label for="exampleInputName1">Position</label>
                        <input type="text" class="form-control" placeholder="position" name="core_data[position]">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Wheel Diameter (Inch)</label>
                        <input type="text" class="form-control" placeholder="wheel_diameter" name="core_data[wheel_diameter]">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Construction</label>
                        <input type="text" class="form-control" placeholder="construction" name="core_data[construction]">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Rated Voltage (DCV)</label>
                        <input type="text" class="form-control" placeholder="rated_voltage" name="core_data[rated_voltage]">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">n0 (Rpm)</label>
                        <input type="text" class="form-control" placeholder="n0" name="core_data[n0]">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Rated Power (W)</label>
                        <input type="text" class="form-control" placeholder="rated_power" name="core_data[rated_power]">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">nT(Rpm)</label>
                        <input type="text" class="form-control" placeholder="nT" name="core_data[nT]">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Max Torque</label>
                        <input type="text" class="form-control" placeholder="max_torque" name="core_data[max_torque]">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Efficiency (%)</label>
                        <input type="text" class="form-control" placeholder="efficiency" name="core_data[efficiency]">
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputName1">Color</label>
                        <input type="text" class="form-control" placeholder="Color" name="core_data[color]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Weight (kg)</label>
                        <input type="text" class="form-control" placeholder="weight" name="core_data[weight]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Noise Grade (dB)</label>
                        <input type="text" class="form-control" placeholder="noise_grade" name="core_data[noise_grade]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Operating Temperature</label>
                        <input type="text" class="form-control" placeholder="operating_temperature" name="core_data[operating_temperature]">
                    </div> 



                    <h4 style="margin-top:45px">Mounting Parameters</h4> <hr>
                    <div class="form-group">
                        <label for="exampleInputName1">Brake</label>
                        <input type="text" class="form-control" placeholder="brake" name="mounting_parameters[brake]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Installation Widths (mm / OLD)</label>
                        <input type="text" class="form-control" placeholder="installation_widths" name="mounting_parameters[installation_widths]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Max. Housing Diameter (mm)</label>
                        <input type="text" class="form-control" placeholder="max_housing_diameter" name="mounting_parameters[max_housing_diameter]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Cabling Route</label>
                        <input type="text" class="form-control" placeholder="cabling_route" name="mounting_parameters[cabling_route]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Cable Length(mm), Connection Type</label>
                        <input type="text" class="form-control" placeholder="cable_length" name="mounting_parameters[cable_length]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Spoke Specification</label>
                        <input type="text" class="form-control" placeholder="spoke_specification" name="mounting_parameters[spoke_specification]">
                    </div> 



                    <h4 style="margin-top:45px">Further Specifications</h4> <hr>
                    <div class="form-group">
                        <label for="exampleInputName1">Speed Detection Signal (Pulses/Cycle)</label>
                        <input type="text" class="form-control" placeholder="speed_detection_signal" name="further_specifications[speed_detection_signal]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Reduction Ratio</label>
                        <input type="text" class="form-control" placeholder="reduction_ratio" name="further_specifications[reduction_ratio]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Magnet Poles (2P)</label>
                        <input type="text" class="form-control" placeholder="magnet_poles" name="further_specifications[magnet_poles]">
                    </div> 

                    <h4 style="margin-top:45px">Tests & Certifications</h4> <hr>
                    <div class="form-group">
                        <label for="exampleInputName1">IP</label>
                        <input type="text" class="form-control" placeholder="ip" name="certification[ip]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Certifications</label>
                        <input type="text" class="form-control" placeholder="certifications" name="certification[certifications]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Salt Spray Test Standard(h)</label>
                        <input type="text" class="form-control" placeholder="salt_spray_test_standard" name="certification[salt_spray_test_standard]">
                    </div> 


                    <h4 style="margin-top:45px">Dimensions</h4> <hr>
                    <img id="dimention-image-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Dimention Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="dimension_image" onchange="document.getElementById('dimention-image-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension A</label>
                        <input type="text" class="form-control" placeholder="dimension A" name="dimension[a]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension B</label>
                        <input type="text" class="form-control" placeholder="dimension B" name="dimension[b]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension C</label>
                        <input type="text" class="form-control" placeholder="dimension C" name="dimension[c]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension D</label>
                        <input type="text" class="form-control" placeholder="dimension D" name="dimension[d]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension E</label>
                        <input type="text" class="form-control" placeholder="dimension E" name="dimension[e]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension F</label>
                        <input type="text" class="form-control" placeholder="dimension F" name="dimension[f]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension G</label>
                        <input type="text" class="form-control" placeholder="dimension G" name="dimension[g]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension H</label>
                        <input type="text" class="form-control" placeholder="dimension H" name="dimension[h]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension WL</label>
                        <input type="text" class="form-control" placeholder="dimension WL" name="dimension[wl]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension WR</label>
                        <input type="text" class="form-control" placeholder="dimension WR" name="dimension[wr]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension OLD</label>
                        <input type="text" class="form-control" placeholder="dimension OLD" name="dimension[old]">
                    </div> 

                    <h4 style="margin-top:45px">Component Images</h4> <hr>
                    <img id="white-image-1-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">White Image 1</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" onchange="document.getElementById('white-image-1-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <img id="white-image-2-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">White Image 2</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" onchange="document.getElementById('white-image-2-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <img id="black-image-1-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Black Image 1</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" onchange="document.getElementById('black-image-1-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <img id="black-image-2-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Black Image 2</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" onchange="document.getElementById('black-image-2-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')

@endsection