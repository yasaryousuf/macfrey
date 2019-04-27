@extends('admin.layouts.master') @section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
                <h4 class="card-title">Component form</h4>
                <p class="card-description">
                    Edit component
                </p>
                <form action="{{url('component/update')}}" method="POST" name="create-component" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$Component->id}}">
                    <h4 style="margin-top:45px">Basic Information</h4> <hr>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Parent Category:</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="parent_id">
                            <option value="" selected disabled>Choose your option</option>
                            @foreach ($componentCategories as $componentCategory)
                                <option value="{{$componentCategory->id}}" <?= ($componentCategory->id==$Component->component_category_id ? ' selected' : '') ?>>{{$componentCategory->name}}</option>
                            @endforeach

                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{$Component->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Description</label>
                        <textarea class="form-control" placeholder="description" name="description"  required>{{$Component->description}}</textarea>
                    </div>



                    <h4 style="margin-top:45px">Core Data</h4> <hr>
                    <input type="hidden" name="code_data_id" value="{{$Component->core_data->id}}">
                    <div class="form-group">
                        <label for="exampleInputName1">Position</label>
                        <input type="text" class="form-control" placeholder="position" name="core_data[position]"  value="{{$Component->core_data->position}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Wheel Diameter (Inch)</label>
                        <input type="text" class="form-control" placeholder="wheel_diameter" name="core_data[wheel_diameter]" value="{{$Component->core_data->wheel_diameter}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Construction</label>
                        <input type="text" class="form-control" placeholder="construction" name="core_data[construction]" value="{{$Component->core_data->construction}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Rated Voltage (DCV)</label>
                        <input type="text" class="form-control" placeholder="rated_voltage" name="core_data[rated_voltage]" value="{{$Component->core_data->rated_voltage}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">n0 (Rpm)</label>
                        <input type="text" class="form-control" placeholder="n0" name="core_data[n0]" value="{{$Component->core_data->n0}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Rated Power (W)</label>
                        <input type="text" class="form-control" placeholder="rated_power" name="core_data[rated_power]" value="{{$Component->core_data->rated_power}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">nT(Rpm)</label>
                        <input type="text" class="form-control" placeholder="nT" name="core_data[nT]" value="{{$Component->core_data->nT}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Max Torque</label>
                        <input type="text" class="form-control" placeholder="max_torque" name="core_data[max_torque]" value="{{$Component->core_data->max_torque}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Efficiency (%)</label>
                        <input type="text" class="form-control" placeholder="efficiency" name="core_data[efficiency]" value="{{$Component->core_data->efficiency}}">
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputName1">Color</label>
                        <input type="text" class="form-control" placeholder="Color" name="core_data[color]" value="{{$Component->core_data->color}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Weight (kg)</label>
                        <input type="text" class="form-control" placeholder="weight" name="core_data[weight]" value="{{$Component->core_data->weight}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Noise Grade (dB)</label>
                        <input type="text" class="form-control" placeholder="noise_grade" name="core_data[noise_grade]" value="{{$Component->core_data->noise_grade}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Operating Temperature</label>
                        <input type="text" class="form-control" placeholder="operating_temperature" name="core_data[operating_temperature]" value="{{$Component->core_data->operating_temperature}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Suitability</label>
                        <input type="text" class="form-control" placeholder="suitability" name="core_data[suitability]" value="{{$Component->core_data->suitability}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Com. Protocol</label>
                        <input type="text" class="form-control" placeholder="com_protocol" name="core_data[com_protocol]" value="{{$Component->core_data->com_protocol}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Display Type</label>
                        <input type="text" class="form-control" placeholder="display_type" name="core_data[display_type]" value="{{$Component->core_data->display_type}}">
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputName1">Display</label>
                        <input type="text" class="form-control" placeholder="display" name="core_data[display]" value="{{$Component->core_data->display}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Support Modes</label>
                        <input type="text" class="form-control" placeholder="support_modes" name="core_data[support_modes]" value="{{$Component->core_data->support_modes}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Nominal Capacity</label>
                        <input type="text" class="form-control" placeholder="nominal_capacity" name="core_data[nominal_capacity]" value="{{$Component->core_data->nominal_capacity}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Resolution</label>
                        <input type="text" class="form-control" placeholder="resolution" name="core_data[resolution]" value="{{$Component->core_data->resolution}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Input Voltage</label>
                        <input type="text" class="form-control" placeholder="input_voltage" name="core_data[input_voltage]" value="{{$Component->core_data->input_voltage}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Output Voltage</label>
                        <input type="text" class="form-control" placeholder="output_voltage" name="core_data[output_voltage]" value="{{$Component->core_data->output_voltage}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Type</label>
                        <input type="text" class="form-control" placeholder="type" name="core_data[type]" value="{{$Component->core_data->type}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Signals</label>
                        <input type="text" class="form-control" placeholder="signals" name="core_data[signals]" value="{{$Component->core_data->signals}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Current Limit</label>
                        <input type="text" class="form-control" placeholder="current_limit" name="core_data[current_limit]" value="{{$Component->core_data->current_limit}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Low Voltage Protection</label>
                        <input type="text" class="form-control" placeholder="low_voltage_protection" name="core_data[low_voltage_protection]" value="{{$Component->core_data->low_voltage_protection}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Wire Specification</label>
                        <input type="text" class="form-control" placeholder="wire_specification" name="core_data[wire_specification]" value="{{$Component->core_data->wire_specification}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Teeth Number</label>
                        <input type="text" class="form-control" placeholder="teeth_number" name="core_data[teeth_number]" value="{{$Component->core_data->teeth_number}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Chain Line</label>
                        <input type="text" class="form-control" placeholder="chain_line" name="core_data[chain_line]" value="{{$Component->core_data->chain_line}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Thickness</label>
                        <input type="text" class="form-control" placeholder="thickness" name="core_data[thickness]" value="{{$Component->core_data->thickness}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Chain Wheel Material</label>
                        <input type="text" class="form-control" placeholder="chain_wheel_material" name="core_data[chain_wheel_material]" value="{{$Component->core_data->chain_wheel_material}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Frame Materail</label>
                        <input type="text" class="form-control" placeholder="frame_materail" name="core_data[frame_materail]" value="{{$Component->core_data->frame_materail}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Cover Material</label>
                        <input type="text" class="form-control" placeholder="cover_material" name="core_data[cover_material]" value="{{$Component->core_data->cover_material}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Energy Content</label>
                        <input type="text" class="form-control" placeholder="energy_content" name="core_data[energy_content]" value="{{$Component->core_data->energy_content}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputName1">E-Brake</label>
                        <input type="text" class="form-control" placeholder="e_brake" name="core_data[e_brake]" value="{{$Component->core_data->e_brake}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Gearsensor Function</label>
                        <input type="text" class="form-control" placeholder="gearsensor_function" name="core_data[gearsensor_function]" value="{{$Component->core_data->gearsensor_function}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Light Drive Capacity</label>
                        <input type="text" class="form-control" placeholder="light_drive_capacity" name="core_data[light_drive_capacity]" value="{{$Component->core_data->light_drive_capacity}}">
                    </div>


                    {{--  --}}
                    <h4 style="margin-top:45px">Mounting Parameters</h4> <hr>
                    <input type="hidden" name="mounting_parameter_id" value="{{$Component->mounting_parameter->id}}">
                    <div class="form-group">
                        <label for="exampleInputName1">Brake</label>
                        <input type="text" class="form-control" placeholder="brake" name="mounting_parameters[brake]" value="{{$Component->mounting_parameter->brake}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Installation Widths (mm / OLD)</label>
                        <input type="text" class="form-control" placeholder="installation_widths" name="mounting_parameters[installation_widths]" value="{{$Component->mounting_parameter->installation_widths}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Max. Housing Diameter (mm)</label>
                        <input type="text" class="form-control" placeholder="max_housing_diameter" name="mounting_parameters[max_housing_diameter]" value="{{$Component->mounting_parameter->max_housing_diameter}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Cabling Route</label>
                        <input type="text" class="form-control" placeholder="cabling_route" name="mounting_parameters[cabling_route]" value="{{$Component->mounting_parameter->cabling_route}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Cable Length(mm), Connection Type</label>
                        <input type="text" class="form-control" placeholder="cable_length" name="mounting_parameters[cable_length]" value="{{$Component->mounting_parameter->cable_length}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Spoke Specification</label>
                        <input type="text" class="form-control" placeholder="spoke_specification" name="mounting_parameters[spoke_specification]" value="{{$Component->mounting_parameter->spoke_specification}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Tire Specification</label>
                        <input type="text" class="form-control" placeholder="tire_specification" name="mounting_parameters[tire_specification]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Induction Distance</label>
                        <input type="text" class="form-control" placeholder="induction_distance" name="mounting_parameters[induction_distance]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Mounting Position</label>
                        <input type="text" class="form-control" placeholder="mounting_position" name="mounting_parameters[mounting_position]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Connector Size</label>
                        <input type="text" class="form-control" placeholder="connector_size" name="mounting_parameters[connector_size]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimensions</label>
                        <input type="text" class="form-control" placeholder="dimensions" name="mounting_parameters[dimensions]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Com. Protocol</label>
                        <input type="text" class="form-control" placeholder="com_protocol" name="mounting_parameters[com_protocol]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">E-Brake Level</label>
                        <input type="text" class="form-control" placeholder="e_brake_level" name="mounting_parameters[e_brake_level]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">BB Width</label>
                        <input type="text" class="form-control" placeholder="bb_width" name="mounting_parameters[bb_width]">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Holder</label>
                        <input type="text" class="form-control" placeholder="holder" name="mounting_parameters[holder]">
                    </div> 
                    {{--  --}}


                    <h4 style="margin-top:45px">Further Specifications</h4> <hr>
                    <input type="hidden" name="further_specification_id" value="{{$Component->further_specification->id}}">
                    <div class="form-group">
                        <label for="exampleInputName1">Speed Detection Signal (Pulses/Cycle)</label>
                        <input type="text" class="form-control" placeholder="speed_detection_signal" name="further_specifications[speed_detection_signal]" value="{{$Component->further_specification->speed_detection_signal}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Reduction Ratio</label>
                        <input type="text" class="form-control" placeholder="reduction_ratio" name="further_specifications[reduction_ratio]" value="{{$Component->further_specification->reduction_ratio}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Magnet Poles (2P)</label>
                        <input type="text" class="form-control" placeholder="magnet_poles" name="further_specifications[magnet_poles]" value="{{$Component->further_specification->magnet_poles}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Bluetooth</label>
                        <input type="text" class="form-control" placeholder="bluetooth" name="further_specifications[bluetooth]"  value="{{$Component->further_specification->bluetooth}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">USB Charge</label>
                        <input type="text" class="form-control" placeholder="usb_charge" name="further_specifications[usb_charge]"  value="{{$Component->further_specification->usb_charge}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">USB Communication</label>
                        <input type="text" class="form-control" placeholder="usb_communication" name="further_specifications[usb_communication]"  value="{{$Component->further_specification->usb_communication}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Number of Cells</label>
                        <input type="text" class="form-control" placeholder="number_of_cells" name="further_specifications[number_of_cells]"  value="{{$Component->further_specification->number_of_cells}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Lighting Output Voltage</label>
                        <input type="text" class="form-control" placeholder="lighting_output_voltage" name="further_specifications[lighting_output_voltage]"  value="{{$Component->further_specification->lighting_output_voltage}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Walk Assistance</label>
                        <input type="text" class="form-control" placeholder="walk_assistance" name="further_specifications[walk_assistance]"  value="{{$Component->further_specification->walk_assistance}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Speed Limit</label>
                        <input type="text" class="form-control" placeholder="speed_limit" name="further_specifications[speed_limit]"  value="{{$Component->further_specification->speed_limit}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Gearshift</label>
                        <input type="text" class="form-control" placeholder="gearshift" name="further_specifications[gearshift]"  value="{{$Component->further_specification->gearshift}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Charging Time</label>
                        <input type="text" class="form-control" placeholder="charging_time" name="further_specifications[charging_time]"  value="{{$Component->further_specification->charging_time}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Charging Cycles</label>
                        <input type="text" class="form-control" placeholder="charging_cycles" name="further_specifications[charging_cycles]"  value="{{$Component->further_specification->charging_cycles}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Throttle Voltage Input</label>
                        <input type="text" class="form-control" placeholder="throttle_voltage_input" name="further_specifications[throttle_voltage_input]"  value="{{$Component->further_specification->throttle_voltage_input}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">PAS mode</label>
                        <input type="text" class="form-control" placeholder="pas_mode" name="further_specifications[pas_mode]"  value="{{$Component->further_specification->pas_mode}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Pin Surface Treatment</label>
                        <input type="text" class="form-control" placeholder="pin_surface_treatment" name="further_specifications[pin_surface_treatment]"  value="{{$Component->further_specification->pin_surface_treatment}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Minimum Distance</label>
                        <input type="text" class="form-control" placeholder="minimum_distance" name="further_specifications[minimum_distance]"  value="{{$Component->further_specification->minimum_distance}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Maximum Distance</label>
                        <input type="text" class="form-control" placeholder="maximum_distance" name="further_specifications[maximum_distance]"  value="{{$Component->further_specification->maximum_distance}}">
                    </div>                    

                    {{-- Tests & Certifications --}}
                    <h4 style="margin-top:45px">Tests & Certifications</h4> <hr>
                    <input type="hidden" name="certification_id" value="{{$Component->certification->id}}">
                    <div class="form-group">
                        <label for="exampleInputName1">IP</label>
                        <input type="text" class="form-control" placeholder="ip" name="certification[ip]" value="{{$Component->certification->ip}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Certifications</label>
                        <input type="text" class="form-control" placeholder="certifications" name="certification[certifications]" value="{{$Component->certification->certifications}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Salt Spray Test Standard(h)</label>
                        <input type="text" class="form-control" placeholder="salt_spray_test_standard" name="certification[salt_spray_test_standard]" value="{{$Component->certification->salt_spray_test_standard}}">
                    </div> 
                    {{-- Tests & Certifications --}}

                    <h4 style="margin-top:45px">Dimensions</h4> <hr>
                    <input type="hidden" name="dimention_id" value="{{$Component->dimention->id}}">
                    <img id="dimention-image-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{$Component->dimention->image ? asset('/images/dimension/'.$Component->dimention->image) : asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Dimention Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="dimension_image" onchange="document.getElementById('dimention-image-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension A</label>
                        <input type="text" class="form-control" placeholder="dimension A" name="dimension[A]" value="{{$Component->dimention->A}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension B</label>
                        <input type="text" class="form-control" placeholder="dimension B" name="dimension[B]" value="{{$Component->dimention->B}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension C</label>
                        <input type="text" class="form-control" placeholder="dimension C" name="dimension[C]" value="{{$Component->dimention->C}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension D</label>
                        <input type="text" class="form-control" placeholder="dimension D" name="dimension[D]" value="{{$Component->dimention->D}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension E</label>
                        <input type="text" class="form-control" placeholder="dimension E" name="dimension[E]" value="{{$Component->dimention->E}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension F</label>
                        <input type="text" class="form-control" placeholder="dimension F" name="dimension[F]" value="{{$Component->dimention->F}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension G</label>
                        <input type="text" class="form-control" placeholder="dimension G" name="dimension[G]" value="{{$Component->dimention->G}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension H</label>
                        <input type="text" class="form-control" placeholder="dimension H" name="dimension[H]" value="{{$Component->dimention->H}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension WL</label>
                        <input type="text" class="form-control" placeholder="dimension WL" name="dimension[wl]" value="{{$Component->dimention->wl}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension WR</label>
                        <input type="text" class="form-control" placeholder="dimension WR" name="dimension[wr]" value="{{$Component->dimention->wr}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Dimension OLD</label>
                        <input type="text" class="form-control" placeholder="dimension OLD" name="dimension[old]" value="{{$Component->dimention->old}}">
                    </div> 
                    {{-- dimension ends --}}

                    {{-- Pin --}}


                    {{-- Pin --}}
                    <h4 style="margin-top:45px">Pin</h4> <hr>
                    <input type="hidden" name="pin_id" value="{{$Component->pin->id}}">
                    <img id="pin-image-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{$Component->pin->image ? asset('/images/pin/'.$Component->pin->image) : asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Pin Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="pin_image" onchange="document.getElementById('pin-image-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Pin A</label>
                        <input type="text" class="form-control" placeholder="pin A" name="pin[A]" value="{{$Component->pin->A}}">
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Pin B</label>
                        <input type="text" class="form-control" placeholder="pin B" name="pin[B]" value="{{$Component->pin->B}}">
                    </div>                     
                    {{-- Pin ends --}}                    
                    {{-- Pin ends --}}
                    <?php 
                    $i = 0;
                        foreach ($Component->images as $image_row ) {
                            $component_image[$i] = $image_row->image;
                            $component_image_id[$i] = $image_row->id;
                            $i++;
                        }
                    ?>
                    <h4 style="margin-top:45px">Component Images</h4> <hr>
                    <input type="hidden" name="white_image_1_id" value="{{$component_image_id[0]}}">
                    <input type="hidden" name="white_image_2_id" value="{{$component_image_id[1]}}">
                    <input type="hidden" name="black_image_2_id" value="{{$component_image_id[3]}}">
                    <input type="hidden" name="black_image_1_id" value="{{$component_image_id[2]}}">
                    <img id="white-image-1-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{$component_image[0] ? asset('/images/component_image/'.$component_image[0]) : asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">White Image 1</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="white_image_1" onchange="document.getElementById('white-image-1-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <img id="white-image-2-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{$component_image[1] ? asset('/images/component_image/'.$component_image[1]) : asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">White Image 2</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="white_image_2" onchange="document.getElementById('white-image-2-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <img id="black-image-1-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{$component_image[2] ? asset('/images/component_image/'.$component_image[2]) : asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Black Image 1</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="black_image_1" onchange="document.getElementById('black-image-1-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <img id="black-image-2-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{$component_image[3] ? asset('/images/component_image/'.$component_image[3]) : asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Black Image 2</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="black_image_2" onchange="document.getElementById('black-image-2-preview').src = window.URL.createObjectURL(this.files[0])">
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