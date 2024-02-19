@extends('admin.reports.defult')
@section('css')
<style>
    .table1 {
        width: 100%;
        margin: auto;
        font-size: 14px;
        border: 1px solid #000;
        border-collapse: collapse;
    }

    .table1 th {
        color: #000;
        vertical-align: middle;
        text-align: center;
        border: 1px solid #000;
    }

    .table1 td {
        vertical-align: middle;
        text-align: center;
        border: 1px solid #000;
    }

    .table2 {
        width: 100%;
        margin: auto;
        font-size: 14px;
        border: 0px solid #000;
        border-collapse: collapse;
    }

    .header tr,
    td {
        /* border: 1px solid black; */
        height: 30px;
    }

    .header {
        border-collapse: collapse;
        width: 100%;
    }
</style>
@endsection

@section('body')

<table class="header">
    <tr>
        <td style="width: 10%"><img src="{{asset('images/logo/logo.jpg')}}" alt="" srcset="" width="80px"></td>
        <td style="text-align: center;">
            ຂໍ້ມູນຄົນເຈັບ
        </td>
    </tr>
</table>

<table class="table2" style="padding: 0px">
    <tbody>
        <tr>
            <td>Patient ID : {{$queue->patient->id}}</td>
            <td>Name: {{$queue->patient->lao_first_name}}</td>
            <td>Surname: {{$queue->patient->lao_last_name}}</td>
            <td>gender: {{$queue->patient->gender}}</td>
        </tr>
        <tr>
            <td>Birth date {{ date('d-m-Y', strtotime($queue->patient->birth_date))}}</td>
            <td>Age {{$queue->patient->age}}</td>
            <td>Address: ...</td>
            <td>village: {{$queue->patient->village}}</td>
        </tr>
        <tr>
            <td>district: {{$queue->patient->district}}</td>
            <td>province : {{$queue->patient->province}}</td>
            <td>tell: {{$queue->patient->user->phone}}</td>
        </tr>
    </tbody>
</table>

<table class="table2" style="padding: 0px">
    <tr>
        <td>
            @if (isset($info['chief_complaint']))
            <p>1.chief complaint: {{$info['chief_complaint'] ?? ''}}</p>
            @endif
            @if (isset($info['present_history_of_illness']))
            <p>2.present history of illness: {{$info['present_history_of_illness'] ?? ''}}</p>
            @endif
            @if (isset($info['heent']) || isset($info['neck']) || isset($info['pulmonary_system'])||
            isset($info['cardiovascular_system']) ||
            isset($info['gastrointestinal_system']) || isset($info['urinary_system'])||
            isset($info['muscle_skeleton'])|| isset($info['endocrine_system'])||
            isset($info['nervous_system']))
            <p>3.review of system:</p>
            <ul>
                @if (isset($info['heent']))
                <li>HEENT:{{$info['heent'] ?? ''}}</li>

                @endif
                @if (isset($info['neck']))
                <li>Neck:{{$info['neck'] ?? ''}}</li>

                @endif
                @if (isset($info['pulmonary_system']))
                <li>Pulmonary system:{{$info['pulmonary_system'] ?? ''}}</li>

                @endif
                @if (isset($info['cardiovascular_system']))
                <li>cardiovascular system:{{$info['cardiovascular_system'] ?? ''}}</li>

                @endif
                @if (isset($info['gastrointestinal_system']))
                <li>Gastrointestinal system:{{$info['gastrointestinal_system'] ?? ''}}</li>

                @endif
                @if (isset($info['urinary_system']))
                <li>Urinary system:{{$info['urinary_system'] ?? ''}}</li>

                @endif
                @if (isset($info['muscle_skeleton']))
                <li>Muscle skeleton:{{$info['muscle_skeleton'] ?? ''}}</li>

                @endif
                @if (isset($info['endocrine_system']))
                <li>Endocrine system:{{$info['endocrine_system'] ?? ''}}</li>

                @endif
                @if (isset($info['nervous_system']))
                <li>Nervous system:{{$info['nervous_system'] ?? ''}}</li>

                @endif
            </ul>
            @endif
            @if (isset($info['family_history']) || isset($info['social_history'])|| isset($info['htn'])||
            isset($info['dm'])|| isset($info['type'])|| isset($info['cardiovascular_disease'])||
            isset($info['kidney_disease'])|| isset($info['hematologic_disease'])|| isset($info['tb'])||
            isset($info['hbv'])|| isset($info['cancer']))
            <p>4.past of medical history:</p>
            <ul>
                @if (isset($info['family_history']))
                <li>family history: {{$info['family_history'] ?? ''}}</li>

                @endif
                @if (isset($info['social_history']))
                <li>social history: {{$info['social_history'] ?? ''}}</li>

                @endif
                <li>
                    @if (isset($info['htn']) ||isset($info['dm']) ||isset($info['type'])
                    ||isset($info['cardiovascular_disease'])||isset($info['kidney_disease'])||isset($info['hematologic_disease'])||isset($info['tb'])
                    ||isset($info['hbv']) ||isset($info['hcv']) ||isset($info['cancer']))
                    chronic disease:
                    @endif

                    <ul>
                        @if (isset($info['htn']))
                        <li>HTN:
                            {!! isset($info['htn']) ? ($info['htn'] == 0 ? '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['htn']) ? ($info['htn'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['dm']))
                        <li>DM
                            {!! isset($info['dm']) ? ($info['dm'] == 0 ? '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['dm']) ? ($info['dm'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['type']))
                        <li>type
                            {!! isset($info['type']) ? ($info['type'] == 0 ? '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['type']) ? ($info['type'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['cardiovascular_disease']))
                        <li>Cardiovascular disease
                            {!! isset($info['cardiovascular_disease']) ? ($info['cardiovascular_disease'] == 0 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['cardiovascular_disease']) ? ($info['cardiovascular_disease'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['kidney_disease']))
                        <li>Kidney disease
                            {!! isset($info['kidney_disease']) ? ($info['kidney_disease'] == 0 ? '&#9745;':'&#9744;') :
                            '&#9744'!!} No
                            {!! isset($info['kidney_disease']) ? ($info['kidney_disease'] == 1 ? '&#9745;':'&#9744;') :
                            '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['hematologic_disease']))
                        <li>Hematologic disease
                            {!! isset($info['hematologic_disease']) ? ($info['hematologic_disease'] == 0 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['hematologic_disease']) ? ($info['hematologic_disease'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['tb']))

                        <li>TB
                            {!! isset($info['tb']) ? ($info['tb'] == 0 ? '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['tb']) ? ($info['tb'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['hbv']))
                        <li>HBV
                            {!! isset($info['hbv']) ? ($info['hbv'] == 0 ? '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['hbv']) ? ($info['hbv'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['hcv']))
                        <li>HCV
                            {!! isset($info['hcv']) ? ($info['hcv'] == 0 ? '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['hcv']) ? ($info['hcv'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                        @if (isset($info['cancer']))
                        <li>Cancer
                            {!! isset($info['cancer']) ? ($info['cancer'] == 0 ? '&#9745;':'&#9744;') : '&#9744'!!} No
                            {!! isset($info['cancer']) ? ($info['cancer'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} Yes
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
            @endif
            @if (isset($info['conscious']) || isset($info['active_position']) || isset($info['passive_position']) ||
            isset($info['coma']) || isset($info['development_normal']) || isset($info['development_gigantism']) ||
            isset($info['development_pituitary']) || isset($info['development_dwarfism']) ||
            isset($info['development_cretinism']) ||
            isset($info['nutrition_normal']) || isset($info['nutrition_obesity']) ||
            isset($info['nutrition_emaciation']) ||
            isset($info['nutrition_cachexia']))
            <p>5.physical examination</p>
            @endif
            <ol>
                @if (isset($info['conscious']) || isset($info['active_position']) ||
                isset($info['passive_position']) ||
                isset($info['coma']))
                <li>

                    general appearance:
                    <ul style="list-style-type:none;">
                        @if (isset($info['conscious']))
                        <li>
                            {!! isset($info['conscious']) ? ($info['conscious'] == 1 ? '&#9745;':'&#9744;') :
                            '&#9744'!!}
                            Conscious
                        </li>
                        @endif
                        @if (isset($info['active_position']))
                        <li>
                            {!! isset($info['active_position']) ? ($info['active_position'] == 1 ? '&#9745;':'&#9744;')
                            : '&#9744'!!}
                            active position

                        </li>
                        @endif
                        @if (isset($info['passive_position']))
                        <li>
                            {!! isset($info['passive_position']) ? ($info['passive_position'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!}
                            passive position

                        </li>
                        @endif
                        @if (isset($info['coma']))
                        <li>
                            {!! isset($info['coma']) ? ($info['coma'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!}
                            coma
                        </li>
                        @endif
                    </ul>
                    @if (isset($info['development_normal']) || isset($info['development_gigantism']) ||
                    isset($info['development_pituitary']) || isset($info['development_dwarfism']) ||
                    isset($info['development_cretinism']))
                    <p>Development</p>
                    @endif
                    <ul style="list-style-type:none;">
                        @if (isset($info['development_normal']))
                        <li>
                            {!! isset($info['development_normal']) ? ($info['development_normal'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} normal
                        </li>
                        @endif
                        @if (isset($info['development_gigantism']))
                        <li>
                            {!! isset($info['development_gigantism']) ? ($info['development_gigantism'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} gigantism
                        </li>
                        @endif
                        @if (isset($info['development_pituitary']))
                        <li>
                            {!! isset($info['development_pituitary']) ? ($info['development_pituitary'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} pituitary
                        </li>
                        @endif
                        @if (isset($info['development_dwarfism']))
                        <li>
                            {!! isset($info['development_dwarfism']) ? ($info['development_dwarfism'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} dwarfism
                        </li>
                        @endif
                        @if (isset($info['development_cretinism']))
                        <li>
                            {!! isset($info['development_cretinism']) ? ($info['development_cretinism'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} cretinism
                        </li>
                        @endif





                    </ul>
                    @if ( isset($info['nutrition_normal']) ||
                    isset($info['nutrition_obesity']) || isset($info['nutrition_emaciation']) ||
                    isset($info['nutrition_cachexia']))
                    <p>Nutrition</p>
                    @endif
                    <ul style="list-style-type:none;">
                        @if (isset($info['nutrition_normal']))
                        <li>
                            {!! isset($info['nutrition_normal']) ? ($info['nutrition_normal'] == 1 ?'&#9745;':'&#9744;')
                            : '&#9744'!!} normal
                        </li>
                        @endif
                        @if (isset($info['nutrition_obesity']))
                        <li>
                            {!! isset($info['nutrition_obesity']) ? ($info['nutrition_obesity'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} obesity
                        </li>
                        @endif
                        @if (isset($info['nutrition_emaciation']))
                        <li>
                            {!! isset($info['nutrition_emaciation']) ? ($info['nutrition_emaciation'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} emaciation
                        </li>
                        @endif
                        @if (isset($info['nutrition_cachexia']))
                        <li>
                            {!! isset($info['nutrition_cachexia']) ? ($info['nutrition_cachexia'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} cachexia
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (isset($info['bp']) || isset($info['hr']) || isset($info['pr']) || isset($info['Spo2']) ||
                isset($info['t']) || isset($info['w']) || isset($info['bmi']))
                <li>

                    Vital sign
                    <ul>
                        @if (isset($info['bp']))
                        <li>BP: {{$info['bp'] ?? ''}} mmHg </li>

                        @endif
                        @if (isset($info['hr']))
                        <li>HR: {{$info['hr'] ?? ''}} bpm</li>

                        @endif
                        @if (isset($info['pr']))
                        <li>PR: {{$info['pr'] ?? ''}} </li>

                        @endif
                        @if (isset($info['Spo2']))
                        <li>SpO₂: {{$info['Spo2'] ?? ''}} %</li>

                        @endif
                        @if (isset($info['t']))
                        <li>T: {{$info['t'] ?? ''}} C⁰</li>

                        @endif
                        @if (isset($info['w']))
                        <li>W: {{$info['w'] ?? ''}} kg</li>

                        @endif
                        @if (isset($info['bmi']))
                        <li>BMI: {{$info['bmi'] ?? ''}} kg</li>

                        @endif
                    </ul>
                </li>
                @endif

                @if (isset($info['thyroid_gland']))

                <li>
                    Thyroid gland:
                    <ul>
                        <li>
                            {!! isset($info['thyroid_gland']) ? ($info['thyroid_gland'] == 'normal' ?
                            '&#9745;':'&#9744;'): '&#9744'!!} normal
                        </li>
                        <li>
                            {!! isset($info['thyroid_gland']) ? ($info['thyroid_gland'] == 'abnormal'
                            ?'&#9745;':'&#9744;') : '&#9744'!!} abnormal
                        </li>
                    </ul>
                </li>
                @endif
                @if (isset($info['skin']))
                <li>
                    Skin:
                    <ul>
                        <li>
                            {!! isset($info['skin']) ? ($info['skin'] == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                            normal

                        </li>
                        <li>
                            {!! isset($info['skin']) ? ($info['skin'] == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                            abnormal

                        </li>
                    </ul>
                </li>
                @endif

                @if (isset($info['lymph_node']))
                <li>
                    Lymph node:
                    <ul>
                        <li>
                            {!! isset($info['lymph_node']) ? ($info['lymph_node'] == 'normal' ? '&#9745;':'&#9744;'):
                            '&#9744'!!} normal
                        </li>
                        <li>
                            {!! isset($info['lymph_node']) ? ($info['lymph_node'] == 'abnormal' ? '&#9745;':'&#9744;'):
                            '&#9744'!!} abnormal
                        </li>
                    </ul>
                </li>
                @endif
                @if (isset($info['respiratory_system_inspection']) || isset($info['repiratory_rhythm_regular'])||
                isset($info['repiratory_rhythm_tachypnea'])|| isset($info['repiratory_rhythm_bradypnea'])||
                isset($info['repiratory_rhythm_dyspnea'])|| isset($info['repiratory_rhythm_orthopnea'])||
                isset($info['repiratory_rhythm_positive_three_depressions_sign'])||
                isset($info['repiratory_rhythm_caynosis'])||
                isset($info['repiratory_rhythm_asymmetric_chest'])|| isset($info['repiratory_rhythm_flat_chest'])||
                isset($info['repiratory_rhythm_barrel_chest'])|| isset($info['repiratory_rhythm_furnnel_chest'])||
                isset($info['repiratory_rhythm_pigeon_chest'])||
                isset($info['repiratory_rhythm_subcutanous_emphysema'])||
                isset($info['respiratory_system_palpation'])|| isset($info['describe_abnormality_decrease'])||
                isset($info['describe_abnormality_in_crease'])|| isset($info['describe_abnormality_left_sight'])||
                isset($info['describe_abnormality_right_sight']) || isset($info['vocal_fremitus_decrease'])||
                isset($info['vocal_fremitus_in_crease'])|| isset($info['vocal_fremitus_left_sight'])||
                isset($info['vocal_fremitus_right_sight'])|| isset($info['pleural_friction_fremitus_positive'])||
                isset($info['pleural_friction_fremitus_negative'])||
                isset($info['pleural_friction_fremitus_left_sight']) ||
                isset($info['pleural_friction_fremitus_right_sight'])|| isset($info['respiratory_system_percussion'])||
                isset($info['dullness_left_sight'])|| isset($info['dullness_right_sight'])||
                isset($info['tympany_left_sight'])|| isset($info['tympany_right_sight'])||
                isset($info['hyperresonance_left_sight'])|| isset($info['hyperresonance_right_sight'])||
                isset($info['respiratory_system_auscultation'])|| isset($info['respiratory_system_auscultation'])||
                isset($info['breath_sound_decrease'])|| isset($info['breath_sound_in_crease'])||
                isset($info['breath_sound_left_sight'])|| isset($info['breath_sound_right_sight']) ||
                isset($info['crepitation_coarse'])|| isset($info['crepitation_medium'])
                || isset($info['crepitation_fine']) || isset($info['crepitation_crepitus']) ||
                isset($info['crepitation_left_sight']) || isset($info['crepitation_right_sight'])
                || isset($info['wheeze_sibilant']) || isset($info['wheeze_sonorous']) ||
                isset($info['wheeze_right_sight']) || isset($info['wheeze_left_sight']) ||
                isset($info['pleural_friction_rub_positive']) || isset($info['pleural_friction_rub_negative']) ||
                isset($info['pleural_friction_rub_right_sight']) || isset($info['pleural_friction_rub_left_sight']) ||
                isset($info['cardiovascular_system_inspection']) || isset($info['clubbing_finger']) ||
                isset($info['positive_jugular_vein_distention'])|| isset($info['apical_impulse_at'])||
                isset($info['cardiovascular_system_palpation'])|| isset($info['mitral_area'])||
                isset($info['aortic_area'])|| isset($info['tricuspid_area'])||
                isset($info['pulmonary_area'])|| isset($info['left_ventricular_heave'])||
                isset($info['right_ventricular_heave'])|| isset($info['pericardial_friction_fremitus'])||
                isset($info['cardiovascular_system_percussion'])|| isset($info['left_sight_enlargement'])||
                isset($info['right_sight_enlargement'])|| isset($info['cardiovascular_system_auscultation'])||
                isset($info['tachycardia'])|| isset($info['bradycardia'])||
                isset($info['S1_decrease'])|| isset($info['S1_increase'])||
                isset($info['S1_splitting'])|| isset($info['S2_decrease'])||
                isset($info['S2_increase'])|| isset($info['S2_splitting'])||
                isset($info['general_splitting'])|| isset($info['fixed_splitting']) ||
                isset($info['paradoxical_splitting'])|| isset($info['gallop_rhythm'])||
                isset($info['protodiastolic_gallop'])|| isset($info['late_diastolic_gallop'])||
                isset($info['summation_gallop'])|| isset($info['opening_snap'])||
                isset($info['pericardial_knock'])|| isset($info['tumor_plop'])||
                isset($info['click'])
                )
                <li>
                    Respiratory system:

                    @if (isset($info['respiratory_system_inspection']))
                    Inspection
                    <ul>
                        <li>
                            {!! isset($info['respiratory_system_inspection']) ? ($info['respiratory_system_inspection']
                            == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                        </li>
                        <li>
                            {!! isset($info['respiratory_system_inspection']) ? ($info['respiratory_system_inspection']
                            == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                        </li>
                    </ul>
                    @endif

                    @if (
                    isset($info['repiratory_rhythm_regular'])||
                    isset($info['repiratory_rhythm_tachypnea'])|| isset($info['repiratory_rhythm_bradypnea'])||
                    isset($info['repiratory_rhythm_dyspnea'])|| isset($info['repiratory_rhythm_orthopnea'])||
                    isset($info['repiratory_rhythm_positive_three_depressions_sign'])||
                    isset($info['repiratory_rhythm_caynosis'])||
                    isset($info['repiratory_rhythm_asymmetric_chest'])|| isset($info['repiratory_rhythm_flat_chest'])||
                    isset($info['repiratory_rhythm_barrel_chest'])|| isset($info['repiratory_rhythm_furnnel_chest'])||
                    isset($info['repiratory_rhythm_pigeon_chest'])||
                    isset($info['repiratory_rhythm_subcutanous_emphysema'])
                    )
                    Discribe abnormality:
                    <ul style="list-style-type:none;">
                        repiratory rhythm:
                        @if (isset($info['repiratory_rhythm_regular']))
                        <li>
                            {!! isset($info['repiratory_rhythm_regular']) ? ($info['repiratory_rhythm_regular'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} regular
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_tachypnea']))
                        <li>
                            {!! isset($info['repiratory_rhythm_tachypnea']) ? ($info['repiratory_rhythm_tachypnea'] == 1
                            ? '&#9745;':'&#9744;') : '&#9744'!!} tachypnea
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_bradypnea']))
                        <li>
                            {!! isset($info['repiratory_rhythm_bradypnea']) ? ($info['repiratory_rhythm_bradypnea'] == 1
                            ? '&#9745;':'&#9744;') : '&#9744'!!} bradypnea
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_dyspnea']))
                        <li>
                            {!! isset($info['repiratory_rhythm_dyspnea']) ? ($info['repiratory_rhythm_dyspnea'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} dyspnea
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_orthopnea']))
                        <li>
                            {!! isset($info['repiratory_rhythm_orthopnea']) ? ($info['repiratory_rhythm_orthopnea'] == 1
                            ? '&#9745;':'&#9744;') : '&#9744'!!} orthopnea
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_positive_three_depressions_sign']))
                        <li>
                            {!! isset($info['repiratory_rhythm_positive_three_depressions_sign']) ?
                            ($info['repiratory_rhythm_positive_three_depressions_sign'] == 1 ? '&#9745;':'&#9744;') :
                            '&#9744'!!} positive three depressions sign
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_caynosis']))
                        <li>
                            {!! isset($info['repiratory_rhythm_caynosis']) ? ($info['repiratory_rhythm_caynosis'] == 1 ?
                            '&#9745;':'&#9744;') : '&#9744'!!} caynosis
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_asymmetric_chest']))
                        <li>
                            {!! isset($info['repiratory_rhythm_asymmetric_chest']) ?
                            ($info['repiratory_rhythm_asymmetric_chest'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!}
                            asymmetric chest
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_flat_chest']))
                        <li>
                            {!! isset($info['repiratory_rhythm_flat_chest']) ? ($info['repiratory_rhythm_flat_chest'] ==
                            1 ? '&#9745;':'&#9744;') : '&#9744'!!} flat chest
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_barrel_chest']))
                        <li>
                            {!! isset($info['repiratory_rhythm_barrel_chest']) ?
                            ($info['repiratory_rhythm_barrel_chest'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} barrel
                            chest
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_furnnel_chest']))
                        <li>
                            {!! isset($info['repiratory_rhythm_furnnel_chest']) ?
                            ($info['repiratory_rhythm_furnnel_chest'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} furnnel
                            chest
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_pigeon_chest']))
                        <li>
                            {!! isset($info['repiratory_rhythm_pigeon_chest']) ?
                            ($info['repiratory_rhythm_pigeon_chest'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!} pigeon
                            chest
                        </li>
                        @endif
                        @if (isset($info['repiratory_rhythm_subcutanous_emphysema']))
                        <li>
                            {!! isset($info['repiratory_rhythm_subcutanous_emphysema']) ?
                            ($info['repiratory_rhythm_subcutanous_emphysema'] == 1 ? '&#9745;':'&#9744;') : '&#9744'!!}
                            subcutanous emphysema
                        </li>
                        @endif
                    </ul>
                    @endif
                    @if (isset($info['respiratory_system_palpation']))
                    <ul>
                        <li>
                            {!! isset($info['respiratory_system_palpation']) ? ($info['respiratory_system_palpation'] ==
                            'normal' ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                        </li>
                        <li>
                            {!! isset($info['respiratory_system_palpation']) ? ($info['respiratory_system_palpation'] ==
                            'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                        </li>
                    </ul>
                    @endif
                    Palpation

                    @if (isset($info['describe_abnormality_decrease'])||
                    isset($info['describe_abnormality_in_crease'])|| isset($info['describe_abnormality_left_sight'])||
                    isset($info['describe_abnormality_right_sight']))
                    <ul style="list-style-type:none;">
                        Thoracic expension:
                        @if (isset($info['describe_abnormality_decrease']))
                        <li>
                            {!! isset($info['describe_abnormality_decrease']) ? ($info['describe_abnormality_decrease']
                            == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} decrease
                        </li>
                        @endif
                        @if (isset($info['describe_abnormality_in_crease']))
                        <li>
                            {!! isset($info['describe_abnormality_in_crease']) ?
                            ($info['describe_abnormality_in_crease'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} increase
                        </li>
                        @endif
                        @if (isset($info['describe_abnormality_left_sight']))
                        <li>
                            {!! isset($info['describe_abnormality_left_sight']) ?
                            ($info['describe_abnormality_left_sight'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} left
                            sight
                        </li>
                        @endif
                        @if (isset($info['describe_abnormality_right_sight']))
                        <li>
                            {!! isset($info['describe_abnormality_right_sight']) ?
                            ($info['describe_abnormality_right_sight'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} right
                            sight
                        </li>
                        @endif
                    </ul>
                    @endif
                    @if (isset($info['vocal_fremitus_decrease'])||
                    isset($info['vocal_fremitus_in_crease'])|| isset($info['vocal_fremitus_left_sight'])||
                    isset($info['vocal_fremitus_right_sight']))
                    <ul style="list-style-type:none;">
                        Vocal fremitus:
                        @if (isset($info['vocal_fremitus_decrease']))
                        <li>
                            {!! isset($info['vocal_fremitus_decrease']) ? ($info['vocal_fremitus_decrease'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} decrease
                        </li>
                        @endif
                        @if (isset($info['vocal_fremitus_in_crease']))
                        <li>
                            {!! isset($info['vocal_fremitus_in_crease']) ? ($info['vocal_fremitus_in_crease'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} increase
                        </li>
                        @endif
                        @if (isset($info['vocal_fremitus_left_sight']))
                        <li>
                            {!! isset($info['vocal_fremitus_left_sight']) ? ($info['vocal_fremitus_left_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} left sight
                        </li>
                        @endif
                        @if (isset($info['vocal_fremitus_right_sight']))
                        <li>
                            {!! isset($info['vocal_fremitus_right_sight']) ? ($info['vocal_fremitus_right_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} right sight
                        </li>
                        @endif
                    </ul>
                    @endif

                    @if (isset($info['pleural_friction_fremitus_positive'])||
                    isset($info['pleural_friction_fremitus_negative'])||
                    isset($info['pleural_friction_fremitus_left_sight']) ||
                    isset($info['pleural_friction_fremitus_right_sight']))
                    <ul style="list-style-type:none;">
                        Pleural friction fremitus:
                        @if (isset($info['pleural_friction_fremitus_positive']))
                        <li>
                            {!! isset($info['pleural_friction_fremitus_positive']) ?
                            ($info['pleural_friction_fremitus_positive'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                            positive
                        </li>
                        @endif
                        @if (isset($info['pleural_friction_fremitus_negative']))
                        <li>
                            {!! isset($info['pleural_friction_fremitus_negative']) ?
                            ($info['pleural_friction_fremitus_negative'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                            negative
                        </li>
                        @endif
                        @if (isset($info['pleural_friction_fremitus_left_sight']))
                        <li>
                            {!! isset($info['pleural_friction_fremitus_left_sight']) ?
                            ($info['pleural_friction_fremitus_left_sight'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} left
                            sight
                        </li>
                        @endif
                        @if (isset($info['pleural_friction_fremitus_right_sight']))
                        <li>
                            {!! isset($info['pleural_friction_fremitus_right_sight']) ?
                            ($info['pleural_friction_fremitus_right_sight'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                            right sight
                        </li>
                        @endif
                    </ul>
                    @endif

                    @if (isset($info['respiratory_system_percussion']))
                    Percussion
                    <ul>
                        <li>
                            {!! isset($info['respiratory_system_percussion']) ? ($info['respiratory_system_percussion']
                            == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                        </li>
                        <li>
                            {!! isset($info['respiratory_system_percussion']) ? ($info['respiratory_system_percussion']
                            == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                        </li>
                    </ul>
                    @endif

                    @if ( isset($info['dullness_left_sight'])|| isset($info['dullness_right_sight']))
                    <ul style="list-style-type:none;">
                        Dullness:

                        @if (isset($info['dullness_left_sight']))
                        <li>
                            {!! isset($info['dullness_left_sight']) ? ($info['dullness_left_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} left sight
                        </li>
                        @endif
                        @if (isset($info['dullness_right_sight']))
                        <li>
                            {!! isset($info['dullness_right_sight']) ? ($info['dullness_right_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} right sight
                        </li>
                        @endif
                    </ul>
                    @endif
                    @if (isset($info['tympany_left_sight']) || isset($info['tympany_right_sight']))
                    <ul style="list-style-type:none;">
                        Tympany:

                        @if (isset($info['tympany_left_sight']))
                        <li>
                            {!! isset($info['tympany_left_sight']) ? ($info['tympany_left_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} left sight

                        </li>
                        @endif
                        @if (isset($info['tympany_right_sight']))
                        <li>
                            {!! isset($info['tympany_right_sight']) ? ($info['tympany_right_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} right sight

                        </li>
                        @endif
                    </ul>
                    @endif

                    @if (isset($info['hyperresonance_left_sight']) ||
                    isset($info['hyperresonance_right_sight']))
                    <ul style="list-style-type:none;">
                        Hyperresonance:

                        @if (isset($info['hyperresonance_left_sight']))
                        <li>
                            {!! isset($info['hyperresonance_left_sight']) ? ($info['hyperresonance_left_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} left sight

                        </li>
                        @endif
                        @if ( isset($info['hyperresonance_right_sight']))
                        <li>
                            {!! isset($info['hyperresonance_right_sight']) ? ($info['hyperresonance_right_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} right sight

                        </li>
                        @endif
                    </ul>
                    @endif

                    @if (isset($info['respiratory_system_auscultation']))
                    Auscultation
                    <ul>
                        <li>
                            {!! isset($info['respiratory_system_auscultation']) ?
                            ($info['respiratory_system_auscultation'] == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                            normal
                        </li>
                        <li>
                            {!! isset($info['respiratory_system_auscultation']) ?
                            ($info['respiratory_system_auscultation'] == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                            abnormal
                        </li>
                    </ul>
                    @endif
                    @if (isset($info['breath_sound_decrease']) ||
                    isset($info['breath_sound_in_crease']) ||
                    isset($info['breath_sound_left_sight']) ||
                    isset($info['breath_sound_right_sight']))
                    <ul style="list-style-type:none;">
                        Breath sound:
                        @if (isset($info['breath_sound_decrease']))
                        <li>
                            {!! isset($info['breath_sound_decrease']) ? ($info['breath_sound_decrease'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} decrease
                        </li>
                        @endif
                        @if (isset($info['breath_sound_in_crease']))
                        <li>
                            {!! isset($info['breath_sound_in_crease']) ? ($info['breath_sound_in_crease'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} increase
                        </li>
                        @endif
                        @if ( isset($info['breath_sound_left_sight']))
                        <li>
                            {!! isset($info['breath_sound_left_sight']) ? ($info['breath_sound_left_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} left sight
                        </li>
                        @endif
                        @if (isset($info['breath_sound_right_sight'])))
                        <li>
                            {!! isset($info['breath_sound_right_sight']) ? ($info['breath_sound_right_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} right sight
                        </li>
                        @endif
                    </ul>
                    @endif

                    @if (isset($info['crepitation_coarse']) ||
                    isset($info['crepitation_medium']) ||
                    isset($info['crepitation_fine']) ||
                    isset($info['crepitation_crepitus']) ||
                    isset($info['crepitation_left_sight']) ||
                    isset($info['crepitation_right_sight'])
                    )
                    <ul style="list-style-type:none;">
                        crepitation:
                        @if (isset($info['crepitation_coarse']))
                        <li>
                            {!! isset($info['crepitation_coarse']) ? ($info['crepitation_coarse'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} coarse
                        </li>
                        @endif
                        @if ( isset($info['crepitation_medium']))
                        <li>
                            {!! isset($info['crepitation_medium']) ? ($info['crepitation_medium'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} medium
                        </li>
                        @endif
                        @if ( isset($info['crepitation_fine']))
                        <li>
                            {!! isset($info['crepitation_fine']) ? ($info['crepitation_fine'] == 1 ?'&#9745;':'&#9744;')
                            : '&#9744'!!} fine
                        </li>
                        @endif
                        @if ( isset($info['crepitation_crepitus']))
                        <li>
                            {!! isset($info['crepitation_crepitus']) ? ($info['crepitation_crepitus'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} crepitus
                        </li>
                        @endif
                        @if ( isset($info['crepitation_left_sight']))
                        <li>
                            {!! isset($info['crepitation_left_sight']) ? ($info['crepitation_left_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} left sight
                        </li>
                        @endif
                        @if ( isset($info['crepitation_right_sight']))
                        <li>
                            {!! isset($info['crepitation_right_sight']) ? ($info['crepitation_right_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} right sight
                        </li>
                        @endif
                    </ul>
                    @endif

                    @if (isset($info['wheeze_sibilant']) ||
                    isset($info['wheeze_sonorous']) ||
                    isset($info['wheeze_right_sight']) ||
                    isset($info['wheeze_left_sight'])
                    )
                    <ul style="list-style-type:none;">
                        Wheeze:
                        @if (isset($info['wheeze_sibilant']))
                        <li>
                            {!! isset($info['wheeze_sibilant']) ? ($info['wheeze_sibilant'] == 1 ?'&#9745;':'&#9744;') :
                            '&#9744'!!} sibilant
                        </li>
                        @endif
                        @if ( isset($info['wheeze_sonorous']))
                        <li>
                            {!! isset($info['wheeze_sonorous']) ? ($info['wheeze_sonorous'] == 1 ?'&#9745;':'&#9744;') :
                            '&#9744'!!} sonorous
                        </li>
                        @endif

                        @if ( isset($info['wheeze_right_sight']))
                        <li>
                            {!! isset($info['wheeze_right_sight']) ? ($info['wheeze_right_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} left sight
                        </li>
                        @endif
                        @if ( isset($info['wheeze_left_sight']))
                        <li>
                            {!! isset($info['wheeze_left_sight']) ? ($info['wheeze_left_sight'] == 1
                            ?'&#9745;':'&#9744;') : '&#9744'!!} right sight
                        </li>
                        @endif
                    </ul>
                    @endif

                    @if (isset($info['pleural_friction_rub_positive']) ||
                    isset($info['pleural_friction_rub_negative']) ||
                    isset($info['pleural_friction_rub_right_sight']) ||
                    isset($info['pleural_friction_rub_left_sight'])
                    )
                    <ul style="list-style-type:none;">
                        Pleural friction rub:
                        @if (isset($info['pleural_friction_rub_positive']))
                        <li>
                            {!! isset($info['pleural_friction_rub_positive']) ? ($info['pleural_friction_rub_positive']
                            == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                        </li>
                        @endif
                        @if ( isset($info['pleural_friction_rub_negative']))
                        <li>
                            {!! isset($info['pleural_friction_rub_negative']) ? ($info['pleural_friction_rub_negative']
                            == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                        </li>
                        @endif

                        @if ( isset($info['pleural_friction_rub_right_sight']))
                        <li>
                            {!! isset($info['pleural_friction_rub_right_sight']) ?
                            ($info['pleural_friction_rub_right_sight'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} left
                            sight
                        </li>
                        @endif
                        @if ( isset($info['pleural_friction_rub_left_sight']))
                        <li>
                            {!! isset($info['pleural_friction_rub_left_sight']) ?
                            ($info['pleural_friction_rub_left_sight'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} right
                            sight
                        </li>
                        @endif
                    </ul>
                    @endif



                </li>
                @endif

                @if (
                isset($info['cardiovascular_system_inspection']) ||
                isset($info['clubbing_finger']) ||
                isset($info['positive_jugular_vein_distention']) ||
                isset($info['apical_impulse_at']) ||
                isset($info['cardiovascular_system_palpation']) ||
                isset($info['mitral_area']) ||
                isset($info['aortic_area']) ||
                isset($info['tricuspid_area']) ||
                isset($info['pulmonary_area']) ||
                isset($info['left_ventricular_heave']) ||
                isset($info['right_ventricular_heave']) ||
                isset($info['pericardial_friction_fremitus']) ||
                isset($info['cardiovascular_system_percussion']) ||
                isset($info['left_sight_enlargement']) ||
                isset($info['right_sight_enlargement']) ||
                isset($info['cardiovascular_system_auscultation']) ||
                isset($info['tachycardia']) ||
                isset($info['bradycardia']) ||
                isset($info['S1_decrease']) ||
                isset($info['S1_increase']) ||
                isset($info['S1_splitting']) ||
                isset($info['S2_decrease']) ||
                isset($info['S2_increase']) ||
                isset($info['S2_splitting']) ||
                isset($info['general_splitting']) ||
                isset($info['fixed_splitting']) ||
                isset($info['paradoxical_splitting']) ||
                isset($info['gallop_rhythm']) ||
                isset($info['protodiastolic_gallop']) ||
                isset($info['late_diastolic_gallop']) ||
                isset($info['summation_gallop']) ||
                isset($info['opening_snap']) ||
                isset($info['pericardial_knock']) ||
                isset($info['tumor_plop']) ||
                isset($info['click'])

                )
                <li>Cardiovascular system</li>
                @if ( isset($info['cardiovascular_system_inspection']))
                Inspection
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['cardiovascular_system_inspection']) ?
                        ($info['cardiovascular_system_inspection'] == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        normal
                    </li>
                    <li>
                        {!! isset($info['cardiovascular_system_inspection']) ?
                        ($info['cardiovascular_system_inspection'] == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        abnormal
                    </li>
                </ul>
                @endif
                @if (
                isset($info['clubbing_finger']) ||
                isset($info['positive_jugular_vein_distention']) ||
                isset($info['apical_impulse_at'])
                )
                <ul style="list-style-type:none;">
                    Describe abnormality :
                    @if ( isset($info['clubbing_finger']))
                    <li>
                        {!! isset($info['clubbing_finger']) ? ($info['clubbing_finger'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} Clubbing finger
                    </li>
                    @endif
                    @if ( isset($info['positive_jugular_vein_distention']))
                    <li>
                        {!! isset($info['positive_jugular_vein_distention']) ?
                        ($info['positive_jugular_vein_distention'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                        jugular vein distention
                    </li>
                    @endif
                    @if ( isset($info['apical_impulse_at']))
                    <li>
                        {!! isset($info['apical_impulse_at']) ? ($info['apical_impulse_at'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} apical impulse at
                    </li>
                    @endif
                </ul>
                @endif
                @if (isset($info['cardiovascular_system_palpation']))
                Palpation
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['cardiovascular_system_palpation']) ? ($info['cardiovascular_system_palpation']
                        == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['cardiovascular_system_palpation']) ? ($info['cardiovascular_system_palpation']
                        == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (

                isset($info['mitral_area']) ||
                isset($info['aortic_area']) ||
                isset($info['tricuspid_area']) ||
                isset($info['pulmonary_area']) ||
                isset($info['left_ventricular_heave']) ||
                isset($info['right_ventricular_heave']) ||
                isset($info['pericardial_friction_fremitus'])
                )
                <ul style="list-style-type:none;">
                    Thrill :
                    @if ( isset($info['mitral_area']))
                    <li>
                        {!! isset($info['mitral_area']) ? ($info['mitral_area'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        mitral area
                    </li>
                    @endif
                    @if ( isset($info['aortic_area']))
                    <li>
                        {!! isset($info['aortic_area']) ? ($info['aortic_area'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        aortic area
                    </li>
                    @endif

                    @if ( isset($info['tricuspid_area']))
                    <li>
                        {!! isset($info['tricuspid_area']) ? ($info['tricuspid_area'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} tricuspid area
                    </li>
                    @endif
                    @if ( isset($info['pulmonary_area']))
                    <li>
                        {!! isset($info['pulmonary_area']) ? ($info['pulmonary_area'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} pulmonary area
                    </li>
                    @endif
                    @if ( isset($info['left_ventricular_heave']))
                    <li>
                        {!! isset($info['left_ventricular_heave']) ? ($info['left_ventricular_heave'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} Left ventricular heave
                    </li>
                    @endif
                    @if ( isset($info['right_ventricular_heave']))
                    <li>
                        {!! isset($info['right_ventricular_heave']) ? ($info['right_ventricular_heave'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} right ventricular heave
                    </li>
                    @endif
                    @if ( isset($info['pericardial_friction_fremitus']))
                    <li>
                        {!! isset($info['pericardial_friction_fremitus']) ? ($info['pericardial_friction_fremitus'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} pericardial friction fremitus
                    </li>
                    @endif
                </ul>
                @endif

                @if (isset($info['cardiovascular_system_percussion']))
                Percussion
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['cardiovascular_system_percussion']) ?
                        ($info['cardiovascular_system_percussion'] == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        normal
                    </li>
                    <li>
                        {!! isset($info['cardiovascular_system_percussion']) ?
                        ($info['cardiovascular_system_percussion'] == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        abnormal
                    </li>
                </ul>
                @endif
                @if (
                isset($info['left_sight_enlargement'])||
                isset($info['right_sight_enlargement'])
                )
                <ul style="list-style-type:none;">
                    Describe abnormality :
                    <li>
                        {!! isset($info['left_sight_enlargement']) ? ($info['left_sight_enlargement'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} Left sight enlargement
                    </li>
                    <li>
                        {!! isset($info['right_sight_enlargement']) ? ($info['right_sight_enlargement'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} right sight enlargement
                    </li>
                </ul>
                @endif
                @if (isset($info['cardiovascular_system_auscultation']) )
                Auscultation
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['cardiovascular_system_auscultation']) ?
                        ($info['cardiovascular_system_auscultation'] == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        normal
                    </li>
                    <li>
                        {!! isset($info['cardiovascular_system_auscultation']) ?
                        ($info['cardiovascular_system_auscultation'] == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        abnormal
                    </li>
                </ul>
                @endif
                @if (

                isset($info['tachycardia']) ||
                isset($info['bradycardia'])
                )
                <ul style="list-style-type:none;">
                    Heart rate:
                    @if ( isset($info['tachycardia']))
                    <li>
                        {!! isset($info['tachycardia']) ? ($info['tachycardia'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        tachycardia
                    </li>
                    @endif
                    @if ( isset($info['bradycardia']))
                    <li>
                        {!! isset($info['bradycardia']) ? ($info['bradycardia'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        bradycardia
                    </li>
                    @endif
                </ul>
                @endif
                <ul style="list-style-type:none;">
                    Heart sound:
                    @if (isset($info['S1_decrease']))
                    <li>
                        {!! isset($info['S1_decrease']) ? ($info['S1_decrease'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        S1 decrease
                    </li>
                    @endif
                    @if (isset($info['S1_increase']))
                    <li>
                        {!! isset($info['S1_increase']) ? ($info['S1_increase'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        S1 increase
                    </li>
                    @endif
                    @if (isset($info['S1_splitting']))
                    <li>
                        {!! isset($info['S1_splitting']) ? ($info['S1_splitting'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} S1 splitting
                    </li>
                    @endif
                    @if (isset($info['S2_decrease']))
                    <li>
                        {!! isset($info['S2_decrease']) ? ($info['S2_decrease'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        S2 decrease
                    </li>
                    @endif
                    @if (isset($info['S2_increase']))
                    <li>
                        {!! isset($info['S2_increase']) ? ($info['S2_increase'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        S2 increase
                    </li>
                    @endif
                    @if (isset($info['S2_splitting']))
                    <li>
                        {!! isset($info['S2_splitting']) ? ($info['S2_splitting'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} S2 splitting
                    </li>
                    @endif
                    @if (isset($info['general_splitting']))
                    <li>
                        {!! isset($info['general_splitting']) ? ($info['general_splitting'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} general splitting
                    </li>
                    @endif
                    @if (isset($info['fixed_splitting']))
                    <li>
                        {!! isset($info['fixed_splitting']) ? ($info['fixed_splitting'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} fixed splitting
                    </li>
                    @endif
                    @if (isset($info['paradoxical_splitting']))
                    <li>
                        {!! isset($info['paradoxical_splitting']) ? ($info['paradoxical_splitting'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} paradoxical splitting
                    </li>
                    @endif
                </ul>
                <ul style="list-style-type:none;">
                    Extra cardiac sound:
                    @if (isset($info['gallop_rhythm']))
                    <li>
                        {!! isset($info['gallop_rhythm']) ? ($info['gallop_rhythm'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} gallop rhythm
                    </li>
                    @endif

                    @if (isset($info['protodiastolic_gallop']))
                    <li>
                        {!! isset($info['protodiastolic_gallop']) ? ($info['protodiastolic_gallop'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} protodiastolic gallop
                    </li>
                    @endif
                    @if (isset($info['late_diastolic_gallop']))
                    <li>
                        {!! isset($info['late_diastolic_gallop']) ? ($info['late_diastolic_gallop'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} late diastolic gallop
                    </li>
                    @endif
                    @if (isset($info['summation_gallop']))
                    <li>
                        {!! isset($info['summation_gallop']) ? ($info['summation_gallop'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} summation gallop
                    </li>
                    @endif
                    @if (isset($info['opening_snap']))
                    <li>
                        {!! isset($info['opening_snap']) ? ($info['opening_snap'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} Opening snap
                    </li>
                    @endif
                    @if (isset($info['pericardial_knock']))
                    <li>
                        {!! isset($info['pericardial_knock']) ? ($info['pericardial_knock'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} pericardial knock
                    </li>
                    @endif
                    @if (isset($info['tumor_plop']))
                    <li>
                        {!! isset($info['tumor_plop']) ? ($info['tumor_plop'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        tumor plop
                    </li>
                    @endif
                    @if (isset($info['click']))
                    <li>
                        {!! isset($info['click']) ? ($info['click'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} click
                    </li>
                    @endif
                </ul>
                @endif
            </ol>
        </td>
        <td>
            <ol start="8">

                @if (
                isset($info['gastrointestinal_system_inspection']) ||
                isset($info['abdominal_distension']) ||
                isset($info['abdominal_concavity']) ||
                isset($info['spider_nevi']) ||
                isset($info['caput_medusa']) ||
                isset($info['palmar_erythema']) ||
                isset($info['duputrens_contracture']) ||
                isset($info['leukonychia']) ||
                isset($info['gastral_pattern']) ||
                isset($info['intestinal_pattern']) ||
                isset($info['peristalsis']) ||
                isset($info['gastrointestinal_system_palpation']) ||
                isset($info['ruq']) ||
                isset($info['rlq']) ||
                isset($info['luq']) ||
                isset($info['llq']) ||
                isset($info['rebound_tenderness']) ||
                isset($info['positive_peritoneal_irritation_sign']) ||
                isset($info['positive_murphy_sign']) ||
                isset($info['gastrointestinal_percussion']) ||
                isset($info['gastrointestinal_percussion']) ||
                isset($info['resonance']) ||
                isset($info['dullness']) ||
                isset($info['hyperresonance']) ||
                isset($info['positive_fluid_thrill']) ||
                isset($info['shifting_dullness']) ||
                isset($info['cardiovascular_system_auscultation']) ||
                isset($info['cardiovascular_system_auscultation']) ||
                isset($info['bowel_sound_increase']) ||
                isset($info['bowel_sound_decrease']) ||
                isset($info['bowel_sound_decrease_positive_abdominal_aortic_bruits'])
                )
                <li>Gastrointestinal system</li>
                @if ( isset($info['gastrointestinal_system_inspection']) )
                Inspection
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['gastrointestinal_system_inspection']) ?
                        ($info['gastrointestinal_system_inspection'] == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        normal
                    </li>
                    <li>
                        {!! isset($info['gastrointestinal_system_inspection']) ?
                        ($info['gastrointestinal_system_inspection'] == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        abnormal
                    </li>
                </ul>
                @endif
                <ul style="list-style-type:none;">
                    Describe abnormality:
                    @if ( isset($info['abdominal_distension']) )
                    <li>
                        {!! isset($info['abdominal_distension']) ? ($info['abdominal_distension'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} Abdominal distension
                    </li>
                    @endif

                    @if ( isset($info['abdominal_concavity']) )
                    <li>
                        {!! isset($info['abdominal_concavity']) ? ($info['abdominal_concavity'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} abdominal concavity
                    </li>
                    @endif
                    @if ( isset($info['spider_nevi']) )
                    <li>
                        {!! isset($info['spider_nevi']) ? ($info['spider_nevi'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        spider nevi
                    </li>
                    @endif
                    @if ( isset($info['caput_medusa']) )
                    <li>
                        {!! isset($info['caput_medusa']) ? ($info['caput_medusa'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} caput medusa
                    </li>
                    @endif
                    @if ( isset($info['palmar_erythema']) )
                    <li>
                        {!! isset($info['palmar_erythema']) ? ($info['palmar_erythema'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} palmar erythema
                    </li>
                    @endif
                    @if ( isset($info['duputrens_contracture']) )
                    <li>
                        {!! isset($info['duputrens_contracture']) ? ($info['duputrens_contracture'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} duputren’s contracture
                    </li>
                    @endif
                    @if ( isset($info['leukonychia']) )
                    <li>
                        {!! isset($info['leukonychia']) ? ($info['leukonychia'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        leukonychia
                    </li>
                    @endif
                    @if ( isset($info['gastral_pattern']) )
                    <li>
                        {!! isset($info['gastral_pattern']) ? ($info['gastral_pattern'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} Gastral pattern
                    </li>
                    @endif
                    @if ( isset($info['intestinal_pattern']) )
                    <li>
                        {!! isset($info['intestinal_pattern']) ? ($info['intestinal_pattern'] == 1 ?'&#9745;':'&#9744;')
                        : '&#9744'!!} intestinal pattern
                    </li>
                    @endif
                    @if ( isset($info['peristalsis']) )
                    <li>
                        {!! isset($info['peristalsis']) ? ($info['peristalsis'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        peristalsis
                    </li>
                    @endif


                </ul>
                @if (isset($info['gastrointestinal_system_palpation']))
                Palpation
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['gastrointestinal_system_palpation']) ?
                        ($info['gastrointestinal_system_palpation'] == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        normal
                    </li>
                    <li>
                        {!! isset($info['gastrointestinal_system_palpation']) ?
                        ($info['gastrointestinal_system_palpation'] == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        abnormal
                    </li>
                </ul>
                @endif

                <ul style="list-style-type:none;">
                    Tenderness:
                    @if ( isset($info['ruq']))
                    <li>
                        {!! isset($info['ruq']) ? ($info['ruq'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} RUQ
                    </li>
                    @endif

                    @if ( isset($info['rlq']))
                    <li>
                        {!! isset($info['rlq']) ? ($info['rlq'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} RLQ
                    </li>
                    @endif
                    @if ( isset($info['luq']))
                    <li>
                        {!! isset($info['luq']) ? ($info['luq'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} LUQ
                    </li>
                    @endif
                    @if ( isset($info['llq']))
                    <li>
                        {!! isset($info['llq']) ? ($info['llq'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} LLQ
                    </li>
                    @endif
                    @if ( isset($info['rebound_tenderness']) )
                    <li>
                        {!! isset($info['rebound_tenderness']) ? ($info['rebound_tenderness'] == 1 ?'&#9745;':'&#9744;')
                        : '&#9744'!!} rebound tenderness
                    </li>
                    @endif
                    @if ( isset($info['positive_peritoneal_irritation_sign']))
                    <li>
                        {!! isset($info['positive_peritoneal_irritation_sign']) ?
                        ($info['positive_peritoneal_irritation_sign'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!} Positive
                        Peritoneal irritation sign
                    </li>
                    @endif
                    @if ( isset($info['positive_murphy_sign']) )
                    <li>
                        {!! isset($info['positive_murphy_sign']) ? ($info['positive_murphy_sign'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} Positive murphy sign
                    </li>
                    @endif

                </ul>
                Percussion
                @if (isset($info['gastrointestinal_percussion']) )
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['gastrointestinal_percussion']) ? ($info['gastrointestinal_percussion'] ==
                        'normal' ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['gastrointestinal_percussion']) ? ($info['gastrointestinal_percussion'] ==
                        'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                <ul style="list-style-type:none;">
                    General abdominal percussion:
                    @if (isset($info['resonance']))
                    <li>
                        {!! isset($info['resonance']) ? ($info['resonance'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        resonance
                    </li>
                    @endif

                    @if (isset($info['dullness']))
                    <li>
                        {!! isset($info['dullness']) ? ($info['dullness'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                        dullness
                    </li>
                    @endif
                    @if (isset($info['hyperresonance']))
                    <li>
                        {!! isset($info['hyperresonance']) ? ($info['hyperresonance'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} hyperresonance
                    </li>
                    @endif
                    @if ( isset($info['positive_fluid_thrill']) )
                    <li>
                        {!! isset($info['positive_fluid_thrill']) ? ($info['positive_fluid_thrill'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} Positive fluid thrill
                    </li>
                    @endif
                    @if (isset($info['shifting_dullness']))
                    <li>
                        {!! isset($info['shifting_dullness']) ? ($info['shifting_dullness'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} shifting dullness
                    </li>
                    @endif
                </ul>
                @if (isset($info['cardiovascular_system_auscultation']))
                Auscultation
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['cardiovascular_system_auscultation']) ?
                        ($info['cardiovascular_system_auscultation'] == 'normal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        normal
                    </li>
                    <li>
                        {!! isset($info['cardiovascular_system_auscultation']) ?
                        ($info['cardiovascular_system_auscultation'] == 'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!}
                        abnormal
                    </li>
                </ul>
                @endif
                <ul style="list-style-type:none;">
                    Bowel sound:
                    @if (isset($info['bowel_sound_increase']))
                    <li>
                        {!! isset($info['bowel_sound_increase']) ? ($info['bowel_sound_increase'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} increase
                    </li>
                    @endif

                    @if (isset($info['bowel_sound_decrease']))
                    <li>
                        {!! isset($info['bowel_sound_decrease']) ? ($info['bowel_sound_decrease'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} decrease
                    </li>
                    @endif
                    @if (isset($info['bowel_sound_decrease_positive_abdominal_aortic_bruits']))
                    <li>
                        {!! isset($info['bowel_sound_decrease_positive_abdominal_aortic_bruits']) ?
                        ($info['bowel_sound_decrease_positive_abdominal_aortic_bruits'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} positive abdominal aortic bruits
                    </li>
                    @endif
                </ul>
                @endif
                @if (
                isset($info['urinary_system_inspection'])||
                isset($info['urinary_system_palpation'])||
                isset($info['urinary_system_percussion'])
                )
                <li>Urinary system</li>
                @if ( isset($info['urinary_system_inspection']))
                Inspection
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['urinary_system_inspection']) ? ($info['urinary_system_inspection'] == 'normal'
                        ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['urinary_system_inspection']) ? ($info['urinary_system_inspection'] ==
                        'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if ( isset($info['urinary_system_palpation']) )
                Palpation
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['urinary_system_palpation']) ? ($info['urinary_system_palpation'] == 'normal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['urinary_system_palpation']) ? ($info['urinary_system_palpation'] == 'abnormal'
                        ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (isset($info['urinary_system_percussion']))
                Percussion
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['urinary_system_percussion']) ? ($info['urinary_system_percussion'] == 'normal'
                        ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['urinary_system_percussion']) ? ($info['urinary_system_percussion'] ==
                        'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if ( isset($info['urinary_system_auscultation']) )
                Auscultation
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['urinary_system_auscultation']) ? ($info['urinary_system_auscultation'] ==
                        'normal' ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['urinary_system_auscultation']) ? ($info['urinary_system_auscultation'] ==
                        'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @endif
                @if (isset($info['urinary_system_skeleton']))
                <li>skeleton</li>
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['urinary_system_skeleton']) ? ($info['urinary_system_skeleton'] == 'normal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['urinary_system_skeleton']) ? ($info['urinary_system_skeleton'] == 'abnormal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (
                isset($info['urinary_system_nervous_system']) ||
                isset($info['olfactory_nerve']) ||
                isset($info['optic_nerve']) ||
                isset($info['trigeminal_nerve']) ||
                isset($info['facial_nerve']) ||
                isset($info['vestibulocochlear_nerve']) ||
                isset($info['glossopharyngeal_nerve']) ||
                isset($info['vagal_nerve']) ||
                isset($info['accessory_nerve']) ||
                isset($info['hypoglossal_nerve']) ||
                isset($info['muscle_bulk']) ||
                isset($info['muscular_tension']) ||
                isset($info['muscle_strength']) ||
                isset($info['finger_nose_test_negative']) ||
                isset($info['finger_nose_test_positive']) ||
                isset($info['heel_to_shin_test_negative']) ||
                isset($info['heel_to_shin_test_positive']) ||
                isset($info['rapid_alternating_movement_negative']) ||
                isset($info['rapid_alternating_movement_positive']) ||
                isset($info['tandem_walking_negative']) ||
                isset($info['tandem_walking_positive']) ||
                isset($info['romberg_test_negative']) ||
                isset($info['romberg_test_negative']) ||
                isset($info['romberg_test_positive']) ||
                isset($info['pain_increase']) ||
                isset($info['pain_decrease']) ||
                isset($info['light_touch']) ||
                isset($info['position_test']) ||
                isset($info['point_localization']) ||
                isset($info['temperature']) ||
                isset($info['vibration']) ||
                isset($info['two_point_discrimination']) ||
                isset($info['stereognosis_test']) ||
                isset($info['babinski_sign_negative']) ||
                isset($info['babinski_sign_positive']) ||
                isset($info['chaddock_sign_negative']) ||
                isset($info['chaddock_sign_positive']) ||
                isset($info['oppenheim_sign_negative']) ||
                isset($info['oppenheim_sign_positive']) ||
                isset($info['hoffmann_sign_negative']) ||
                isset($info['hoffmann_sign_positive']) ||
                isset($info['kerning_sign_negative']) ||
                isset($info['kerning_sign_positive']) ||
                isset($info['brudzinski_sign_negative']) ||
                isset($info['brudzinski_sign_positive']) ||
                isset($info['stiff_neck_negative']) ||
                isset($info['stiff_neck_positive'])
                )

                @if (isset($info['urinary_system_nervous_system']))
                <li>Nervous system</li>
                <ul style="list-style-type:none;">
                    <li>
                        {!! isset($info['urinary_system_nervous_system']) ? ($info['urinary_system_nervous_system'] ==
                        'normal' ? '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['urinary_system_nervous_system']) ? ($info['urinary_system_nervous_system'] ==
                        'abnormal' ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (isset($info['glasgow_coma_score']))
                <p>Glasgow coma score: {{$info['glasgow_coma_score'] ?? ''}}</p>
                @endif
                Cranial nerve:
                <ol>
                    @if (isset($info['olfactory_nerve']))

                    <li>Olfactory nerve: {{$info['olfactory_nerve'] ?? ''}}</li>

                    @endif
                    @if (isset($info['optic_nerve']))
                    <li>Optic nerve: {{$info['optic_nerve'] ?? ''}}</li>

                    @endif {{-- <li>Oculomotor, trochlear, abducent nerve: {{$info['trigeminal_nerve'] ?? ''}}</li> --}}
                    @if (isset($info['trigeminal_nerve']))

                    <li>Trigeminal nerve: {{$info['trigeminal_nerve'] ?? ''}}</li>

                    @endif
                    @if (isset($info['facial_nerve']))
                    <li>Facial nerve: {{$info['facial_nerve'] ?? ''}}</li>

                    @endif
                    @if (isset($info['vestibulocochlear_nerve']))
                    <li>Vestibulocochlear nerve: {{$info['vestibulocochlear_nerve'] ?? ''}}</li>

                    @endif
                    @if (isset($info['glossopharyngeal_nerve']))
                    <li>Glossopharyngeal nerve: {{$info['glossopharyngeal_nerve'] ?? ''}}</li>

                    @endif
                    @if (isset($info['vagal_nerve']))
                    <li>Vagal nerve: {{$info['vagal_nerve'] ?? ''}}</li>

                    @endif
                    @if (isset($info['accessory_nerve']))
                    <li>Accessory nerve: {{$info['accessory_nerve'] ?? ''}}</li>

                    @endif
                    @if (isset($info['hypoglossal_nerve']))
                    <li>Hypoglossal nerve: {{$info['hypoglossal_nerve'] ?? ''}}</li>

                    @endif
                </ol>
                @if (
                isset($info['muscle_bulk']) ||
                isset($info['muscular_tension']) ||
                isset($info['muscle_strength']) ||
                isset($info['finger_nose_test_negative']) ||
                isset($info['finger_nose_test_positive']) ||
                isset($info['heel_to_shin_test_negative']) ||
                isset($info['heel_to_shin_test_positive']) ||
                isset($info['rapid_alternating_movement_negative']) ||
                isset($info['rapid_alternating_movement_positive']) ||
                isset($info['tandem_walking_negative']) ||
                isset($info['tandem_walking_positive']) ||
                isset($info['romberg_test_negative']) ||
                isset($info['romberg_test_positive'])
                )
                Motor system
                <ol>
                    @if ( isset($info['muscle_bulk']))
                    <li>Muscle bulk: {{$info['muscle_bulk'] ?? ''}}</li>

                    @endif
                    @if (isset($info['muscular_tension']))
                    <li>Muscular tension: {{$info['muscular_tension'] ?? ''}}</li>

                    @endif
                    @if (isset($info['muscle_strength']) )
                    <li>Muscle strength: {{$info['muscle_strength'] ?? ''}}</li>

                    @endif
                    <li>Coordination movement
                        <ul style="list-style-type:none;">
                            @if (
                            isset($info['finger_nose_test_negative'])||
                            isset($info['finger_nose_test_positive'])
                            )
                            Finger-nose test:
                            @if ( isset($info['finger_nose_test_negative']))
                            <li>
                                {!! isset($info['finger_nose_test_negative']) ? ($info['finger_nose_test_negative'] == 1
                                ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                            </li>
                            @endif
                            @if ( isset($info['finger_nose_test_positive']))
                            <li>
                                {!! isset($info['finger_nose_test_positive']) ? ($info['finger_nose_test_positive'] == 1
                                ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                            </li>
                            @endif
                            @endif
                            @if (
                            isset($info['heel_to_shin_test_negative']) ||
                            isset($info['heel_to_shin_test_positive'])
                            )
                            Heel to shin test
                            @if (isset($info['heel_to_shin_test_negative']))
                            <li>
                                {!! isset($info['heel_to_shin_test_negative']) ? ($info['heel_to_shin_test_negative'] ==
                                1 ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                            </li>
                            @endif
                            @if ( isset($info['heel_to_shin_test_positive']))
                            <li>
                                {!! isset($info['heel_to_shin_test_positive']) ? ($info['heel_to_shin_test_positive'] ==
                                1 ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                            </li>
                            @endif
                            @endif
                            @if (
                            isset($info['rapid_alternating_movement_negative']) ||
                            isset($info['rapid_alternating_movement_positive'])
                            )
                            Rapid alternating movement:
                            @if (isset($info['rapid_alternating_movement_negative']))
                            <li>
                                {!! isset($info['rapid_alternating_movement_negative']) ?
                                ($info['rapid_alternating_movement_negative'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                                negative
                            </li>
                            @endif
                            @if ( isset($info['rapid_alternating_movement_positive']))
                            <li>
                                {!! isset($info['rapid_alternating_movement_positive']) ?
                                ($info['rapid_alternating_movement_positive'] == 1 ?'&#9745;':'&#9744;') : '&#9744'!!}
                                positive
                            </li>
                            @endif
                            @endif
                            @if (
                            isset($info['tandem_walking_negative']) ||
                            isset($info['tandem_walking_positive'])
                            )
                            Tandem walking:
                            @if (isset($info['tandem_walking_negative']) )
                            <li>
                                {!! isset($info['tandem_walking_negative']) ? ($info['tandem_walking_negative'] == 1
                                ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                            </li>
                            @endif
                            @if ( isset($info['tandem_walking_positive']))
                            <li>
                                {!! isset($info['tandem_walking_positive']) ? ($info['tandem_walking_positive'] == 1
                                ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                            </li>
                            @endif
                            @endif
                            @if (
                            isset($info['romberg_test_negative']) ||
                            isset($info['romberg_test_positive'])
                            )
                            Romberg test:
                            @if ( isset($info['romberg_test_negative']))
                            <li>
                                {!! isset($info['romberg_test_negative']) ? ($info['romberg_test_negative'] == 1
                                ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                            </li>
                            @endif
                            @if (isset($info['romberg_test_positive']))
                            <li>
                                {!! isset($info['romberg_test_positive']) ? ($info['romberg_test_positive'] == 1
                                ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                            </li>
                            @endif
                            @endif
                        </ul>
                    </li>

                </ol>
                @endif
                @if (
                isset($info['pain_increase']) ||
                isset($info['pain_decrease'])
                )
                Sensory system test:
                <ul style="list-style-type:none;">
                    Pain:
                    @if (isset($info['pain_increase']))
                    <li>
                        {!! isset($info['pain_increase']) ? ($info['pain_increase'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} increase
                    </li>
                    @endif
                    @if (isset($info['pain_decrease']))
                    <li>
                        {!! isset($info['pain_decrease']) ? ($info['pain_decrease'] == 1 ?'&#9745;':'&#9744;') :
                        '&#9744'!!} decrease
                    </li>
                    @endif
                </ul>
                @endif

                @if (isset($info['light_touch']))
                <ul style="list-style-type:none;">
                    Light touch :
                    <li>
                        {!! isset($info['light_touch']) ? ($info['light_touch'] == 'normal' ? '&#9745;':'&#9744;'):
                        '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['light_touch']) ? ($info['light_touch'] == 'abnormal' ? '&#9745;':'&#9744;'):
                        '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (isset($info['position_test']))
                <ul style="list-style-type:none;">
                    Position test
                    <li>
                        {!! isset($info['position_test']) ? ($info['position_test'] == 'normal' ? '&#9745;':'&#9744;'):
                        '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['position_test']) ? ($info['position_test'] == 'abnormal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (isset($info['point_localization']))
                <ul style="list-style-type:none;">
                    Point localization
                    <li>
                        {!! isset($info['point_localization']) ? ($info['point_localization'] == 'normal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['point_localization']) ? ($info['point_localization'] == 'abnormal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (isset($info['temperature']))
                <ul style="list-style-type:none;">
                    temperature
                    <li>
                        {!! isset($info['temperature']) ? ($info['temperature'] == 'normal' ? '&#9745;':'&#9744;'):
                        '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['temperature']) ? ($info['temperature'] == 'abnormal' ? '&#9745;':'&#9744;'):
                        '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (isset($info['vibration']))
                <ul style="list-style-type:none;">
                    vibration
                    <li>
                        {!! isset($info['vibration']) ? ($info['vibration'] == 'normal' ? '&#9745;':'&#9744;'):
                        '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['vibration']) ? ($info['vibration'] == 'abnormal' ? '&#9745;':'&#9744;'):
                        '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (isset($info['two_point_discrimination']))
                <ul style="list-style-type:none;">
                    two-point discrimination
                    <li>
                        {!! isset($info['two_point_discrimination']) ? ($info['two_point_discrimination'] == 'normal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['two_point_discrimination']) ? ($info['two_point_discrimination'] == 'abnormal'
                        ? '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                @if (isset($info['stereognosis_test']))
                <ul style="list-style-type:none;">
                    stereognosis test
                    <li>
                        {!! isset($info['stereognosis_test']) ? ($info['stereognosis_test'] == 'normal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} normal
                    </li>
                    <li>
                        {!! isset($info['stereognosis_test']) ? ($info['stereognosis_test'] == 'abnormal' ?
                        '&#9745;':'&#9744;'): '&#9744'!!} abnormal
                    </li>
                </ul>
                @endif
                <p>Reflex test:</p>
                Pathologic reflex:
                @if (
                isset($info['babinski_sign_negative']) ||
                isset($info['babinski_sign_positive'])
                )
                <ul style="list-style-type:none;">
                    Babinski sign
                    @if (isset($info['babinski_sign_negative']))
                    <li>
                        {!! isset($info['babinski_sign_negative']) ? ($info['babinski_sign_negative'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                    </li>
                    @endif
                    @if ( isset($info['babinski_sign_positive']))
                    <li>
                        {!! isset($info['babinski_sign_positive']) ? ($info['babinski_sign_positive'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                    </li>
                    @endif
                </ul>
                @endif
                @if (
                isset($info['chaddock_sign_negative']) ||
                isset($info['chaddock_sign_positive'])
                )
                <ul style="list-style-type:none;">
                    chaddock sign
                    @if (isset($info['chaddock_sign_negative']))
                    <li>
                        {!! isset($info['chaddock_sign_negative']) ? ($info['chaddock_sign_negative'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                    </li>
                    @endif
                    @if ( isset($info['chaddock_sign_positive']))
                    <li>
                        {!! isset($info['chaddock_sign_positive']) ? ($info['chaddock_sign_positive'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                    </li>
                    @endif
                </ul>
                @endif
                @if (
                isset($info['oppenheim_sign_negative']) ||
                isset($info['oppenheim_sign_positive'])
                )
                <ul style="list-style-type:none;">
                    Oppenheim sign
                    @if ( isset($info['oppenheim_sign_negative']))
                    <li>
                        {!! isset($info['oppenheim_sign_negative']) ? ($info['oppenheim_sign_negative'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                    </li>
                    @endif
                    @if ( isset($info['oppenheim_sign_positive']))
                    <li>
                        {!! isset($info['oppenheim_sign_positive']) ? ($info['oppenheim_sign_positive'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                    </li>
                    @endif
                </ul>
                @endif
                @if (
                isset($info['hoffmann_sign_negative']) ||
                isset($info['hoffmann_sign_positive'])
                )
                <ul style="list-style-type:none;">
                    Hoffmann sign
                    @if ( isset($info['hoffmann_sign_negative']))
                    <li>
                        {!! isset($info['hoffmann_sign_negative']) ? ($info['hoffmann_sign_negative'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                    </li>
                    @endif
                    @if (isset($info['hoffmann_sign_positive']))
                    <li>
                        {!! isset($info['hoffmann_sign_positive']) ? ($info['hoffmann_sign_positive'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                    </li>
                    @endif
                </ul>
                @endif
                @if (
                isset($info['kerning_sign_negative']) ||
                isset($info['kerning_sign_positive'])
                )
                Meningeal irritation sign:
                <ul style="list-style-type:none;">
                    Kerning sign
                    @if ( isset($info['kerning_sign_negative']))
                    <li>
                        {!! isset($info['kerning_sign_negative']) ? ($info['kerning_sign_negative'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                    </li>
                    @endif
                    @if ( isset($info['kerning_sign_positive']))
                    <li>
                        {!! isset($info['kerning_sign_positive']) ? ($info['kerning_sign_positive'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                    </li>
                    @endif
                </ul>
                @endif
                @if (
                isset($info['brudzinski_sign_negative']) ||
                isset($info['brudzinski_sign_positive'])
                )
                <ul style="list-style-type:none;">
                    brudzinski sign
                    <li>
                        {!! isset($info['brudzinski_sign_negative']) ? ($info['brudzinski_sign_negative'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                    </li>
                    <li>
                        {!! isset($info['brudzinski_sign_positive']) ? ($info['brudzinski_sign_positive'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                    </li>
                </ul>
                @endif
                @if (
                isset($info['stiff_neck_negative']) ||
                isset($info['stiff_neck_positive'])
                )
                <ul style="list-style-type:none;">
                    Stiff neck
                    @if ( isset($info['stiff_neck_negative']))
                    <li>
                        {!! isset($info['stiff_neck_negative']) ? ($info['stiff_neck_negative'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} negative
                    </li>
                    @endif
                    @if (isset($info['stiff_neck_positive']))
                    <li>
                        {!! isset($info['stiff_neck_positive']) ? ($info['stiff_neck_positive'] == 1
                        ?'&#9745;':'&#9744;') : '&#9744'!!} positive
                    </li>
                    @endif
                </ul>
                @endif
                @endif
               @if ( isset($info['comment']))
               <li>Comment</li>
               <p>{!!$info['comment'] ?? '' !!}</p>
               @endif

            </ol>
        </td>
    </tr>
</table>

@endsection
@section('script')
<script type="text/javascript">
    window.onload = function() { window.print() }
</script>
@endsection
