@extends('master')

@section('content')
<h2 class="content-heading">Dashboard of <span style="text-transform: uppercase; font-weight: bolder;color: blue;">{{ $respondent->FullName }}</span></h2>
{!! Form::model($respondent,['method'=>'PATCH','action'=>['DashboardController@update',$respondent->id]]) !!}
<div class="row">
    <div class="col-md-12">
        <div class="block block-themed">
            <div class="block-header bg-earth">
                <h3 class="block-title">Personal Information</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Select Recruiter') !!}
                            {!! Form::select('recruiter_id',$recruiters,null,['class'=>'js-select2 form-control','placeholder'=>'PLEASE SELECT','style'=>'width:100%;']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">               
                        <div class="form-group">
                            {!! Form::label('Last Name') !!}
                            {!! Form::text('lastname',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">               
                        <div class="form-group">
                            {!! Form::label('First Name') !!}
                            {!! Form::text('firstname',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">               
                        <div class="form-group">
                            {!! Form::label('Middle Name') !!}
                            {!! Form::text('middlename',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-1">               
                        <div class="form-group">
                            {!! Form::label('Ext') !!}
                            {!! Form::text('extname',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Select Gender') !!}
                            {!! Form::select('gender',['MALE'=>'MALE','FEMALE'=>'FEMALE'],null,['class'=>'js-select2 form-control','placeholder'=>'PLEASE SELECT','style'=>'width:100%;']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Birthdate</label>
                            <input type="text" class="js-flatpickr form-control bg-white" id="example-flatpickr-default" name="birthdate" value="{{ $respondent->birthdate }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Age') !!}
                            {!! Form::text('age',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Occupation') !!}
                            {!! Form::text('occupation',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Email Address') !!}
                            {!! Form::text('email',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Civil Status') !!}
                            {!! Form::select('civil_status',['SINGLE'=>'SINGLE','MARRIED'=>'MARRIED','SEPARATED'=>'SEPARATED','WIDOWED'=>'WIDOWED','DIVORCED'=>'DIVORCED'],null,['class'=>'js-select2 form-control','placeholder'=>'PLEASE SELECT','style'=>'width:100%;']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Address: Unit/House #') !!}
                            {!! Form::text('address_unit',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Street') !!}
                            {!! Form::text('address_street',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Brgy') !!}
                            {!! Form::text('address_brgy',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('City/Municipality') !!}
                            {!! Form::text('address_city',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('Province') !!}
                            {!! Form::text('address_province',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Area') !!}
                            {!! Form::select('area_id',$areas,null,['class'=>'js-select2 form-control','placeholder'=>'PLEASE SELECT','style'=>'width:100%;']) !!}
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="3">Contact Details</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Provider</th>
                                    <th class="text-center">Mobile #</th>
                                    <th class="text-center" width="80">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($respondent->r_contacts as $r)
                                <tr>
                                    <td>{{ $r->network->name }}</td>
                                    <td>{{ $r->mobile }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-condensed table-bordered network-list">
                            <thead>
                                <th class="text-center">Select Network</th>
                                <th class="text-center">Mobile #</th> 
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{!! Form::select('network_id[]',$networks,null,['class'=>'form-control','placeholder'=>'PLEASE SELECT','style'=>'width:100%;']) !!}</td>
                                    <td>{!! Form::text('mobile[]','',['class'=>'form-control','style'=>'width:100%;']) !!}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary add-network-row pull-right"><i class="fa fa-plus"></i> Add Row</a>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
@section('js')
<script type="text/javascript">
    $(window).on('load',function(){
        //$('#myModal').modal('show');
    });
    $('.add-subject-row').on('click', function(){
        subject_new_row = `
            <tr>
                <td><input class="form-control" style="width:100%;" name="child_name[]" type="text" value=""></td>
                <td><input class="form-control" style="width:100%;" name="child_age[]" type="text" value=""></td>
            </tr>`;
        $(".subject-list tbody").append(subject_new_row);
    });

     $('.add-network-row').on('click', function(){
        network_new_row = `
            <tr>
                <td>{!! Form::select('network_id[]',$networks,null,['class'=>'js-select2 form-control','placeholder'=>'PLEASE SELECT','style'=>'width:100%;']) !!}</td>
                <td>{!! Form::text('mobile[]',null,['class'=>'form-control','style'=>'width:100%;']) !!}</td>
            </tr>`;
        $(".network-list tbody").append(network_new_row);
    });

    $('.mi').keyup(function(){
        var mi =$(`.mi`).val();
        var ai = parseFloat(mi) * 12;
        $(`.ai`).val(ai.toFixed(2)); 
        
    });

    $('.ai').keyup(function(){
        var ai =$(`.ai`).val();
        var mi = parseFloat(ai) / 12;
        $(`.mi`).val(mi.toFixed(2)); 
        
    });
</script>
@endsection