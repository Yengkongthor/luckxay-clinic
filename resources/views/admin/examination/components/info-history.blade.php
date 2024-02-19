<div class="row">
    <div class="col">
        <p>1.chief complaint</p>
        <div class="form-group">
            <input class="form-control" id="chief_complaint" type="text" v-model="info.chief_complaint"
                placeholder="chief complaint">
        </div>
        <p>2.present history of illness:</p>
        <div class="form-group">
            <input class="form-control" id="present_history_of_illness" type="text"
                v-model="info.present_history_of_illness" placeholder="present history of illness">
        </div>
        <p>3.review of system:</p>
        <div class="form-group">
            <p for="heent">Heent</p>
            <input class="form-control" id="heent" type="text" placeholder="Heent" v-model="info.heent">
        </div>
        <div class="form-group">
            <p for="Neck">Neck</p>
            <input class="form-control" id="neck" type="text" placeholder="Neck" v-model="info.neck">
        </div>
        <div class="form-group">
            <p for="pulmonary_system">Pulmonary system</p>
            <input class="form-control" id="pulmonary_system" type="text" placeholder="Pulmonary system"
                v-model="info.pulmonary_system">
        </div>
        <div class="form-group">
            <p for="cardiovascular_system">cardiovascular system</p>
            <input class="form-control" id="cardiovascular_system" type="text" placeholder="Cardiovascular system"
                v-model="info.cardiovascular_system">
        </div>
        <div class="form-group">
            <p for="gastrointestinal_system">Gastrointestinal system</p>
            <input class="form-control" id="gastrointestinal_system" type="text" placeholder="Gastrointestinal system"
                v-model="info.gastrointestinal_system">
        </div>
        <div class="form-group">
            <p for="urinary_system">Urinary system</p>
            <input class="form-control" id="urinary_system" type="text" placeholder="Urinary system"
                v-model="info.urinary_system">
        </div>
        <div class="form-group">
            <p for="muscle_skeleton">Muscle skeleton</p>
            <input class="form-control" id="muscle_skeleton" type="text" placeholder="Muscle skeleton"
                v-model="info.muscle_skeleton">
        </div>
        <div class="form-group">
            <p for="endocrine_system">Endocrine system</p>
            <input class="form-control" id="endocrine_system" type="text" placeholder="Endocrine system"
                v-model="info.endocrine_system">
        </div>
        <div class="form-group">
            <p for="nervous_system">Nervous system</p>
            <input class="form-control" id="nervous_system" type="text" placeholder="Nervous system"
                v-model="info.nervous_system">
        </div>
        4. past of medical history: <br>
        <div class="form-group">
            <p for="family_history">family history</p>
            <input class="form-control" id="family_history" type="text" placeholder="family history">
        </div>
        <div class="form-group">
            <p for="social_history">social history</p>
            <input class="form-control" id="social_history" type="text" placeholder="social history">
        </div>

        <p for="">chronic disease: </p> <br>
        <div class="form-group row">
            <div class="col col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="htn" type="checkbox" v-model="info.htn">
                    <label class="form-check-label" for="htn">HTN</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="dm" type="checkbox" v-model="info.dm">
                    <label class="form-check-label" for="dm">DM</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="type" type="checkbox" v-model="info.type">
                    <label class="form-check-label" for="type">type</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_disease" type="checkbox"
                        v-model="info.cardiovascular_disease">
                    <label class="form-check-label" for="cardiovascular_disease">Cardiovascular disease</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="kidney_disease" type="checkbox" v-model="info.kidney_disease">
                    <label class="form-check-label" for="kidney_disease">Kidney disease</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="hematologic_disease" type="checkbox"
                        v-model="info.hematologic_disease">
                    <label class="form-check-label" for="hematologic_disease">Hematologic disease</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="tb" type="checkbox" v-model="info.tb">
                    <label class="form-check-label" for="tb">TB</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="hbv" type="checkbox" v-model="info.hbv">
                    <label class="form-check-label" for="hbv">HBV</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="hcv" type="checkbox" v-model="info.hcv">
                    <label class="form-check-label" for="hcv">HCV</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cancer" type="checkbox" v-model="info.cancer">
                    <label class="form-check-label" for="cancer">Cancer</label>
                </div>
            </div>
        </div>
        <p>5.physical examination</p>
        <div class="form-group">
            <p for="family_history">1. General appearance: </p>
        </div>
        <div class="form-group row">
            <div class="col col-form-label">
                <div class="pb-2">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="conscious" type="checkbox" v-model="info.conscious">
                        <label class="form-check-label" for="conscious">Conscious</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="active_position" type="checkbox"
                            v-model="info.active_position">
                        <label class="form-check-label" for="active_position">Active position</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="passive_position" type="checkbox"
                            v-model="info.passive_position">
                        <label class="form-check-label" for="passive_position">Passive position</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="coma" type="checkbox" v-model="info.coma">
                        <label class="form-check-label" for="coma">Coma</label>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-md-3 col-form-label" for="development">Development</p>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="development_normal" type="checkbox"
                                value="development_normal" v-model="info.development_normal">
                            <label class="form-check-label" for="development_normal">normal</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="development_gigantism" type="checkbox"
                                value="development_gigantism" v-model="info.development_gigantism">
                            <label class="form-check-label" for="development_gigantism">gigantism</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="development_pituitary" type="checkbox"
                                value="development_pituitary" v-model="info.development_pituitary">
                            <label class="form-check-label" for="development_pituitary">pituitary</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="development_dwarfism" type="checkbox"
                                value="development_dwarfism" v-model="info.development_dwarfism">
                            <label class="form-check-label" for="development_dwarfism">dwarfism</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="development_cretinism" type="checkbox"
                                value="development_cretinism" v-model="info.development_cretinism">
                            <label class="form-check-label" for="development_cretinism">cretinism</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-md-3 col-form-label" for="nutrition">Nutrition</p>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="nutrition_normal" type="checkbox"
                                value="nutrition_normal" v-model="info.nutrition_normal">
                            <label class="form-check-label" for="nutrition_normal">normal</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="nutrition_obesity" type="checkbox"
                                value="nutrition_obesity" v-model="info.nutrition_obesity">
                            <label class="form-check-label" for="nutrition_obesity">obesity</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="nutrition_emaciation" type="checkbox"
                                value="nutrition_emaciation" v-model="info.nutrition_emaciation">
                            <label class="form-check-label" for="nutrition_emaciation">emaciation</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="nutrition_cachexia" type="checkbox"
                                value="nutrition_cachexia" v-model="info.nutrition_cachexia">
                            <label class="form-check-label" for="nutrition_cachexia">cachexia</label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <p for="vital_sign: ">2. Vital sign: </p>
                </div>
                <div class="form-group">
                    <p for="BP">BP</p>
                    <input class="form-control" id="BP" type="text" placeholder="BP" v-model="info.bp">
                </div>
                <div class="form-group">
                    <p for="PR">HR</p>
                    <input class="form-control" id="hr" type="text" placeholder="hr" v-model="info.hr">
                </div>
                <div class="form-group">
                    <p for="PR">PR</p>
                    <input class="form-control" id="PR" type="text" placeholder="PR" v-model="info.pr">
                </div>
                <div class="form-group">
                    <p for="SpO₂">SpO₂</p>
                    <input class="form-control" id="SpO₂" type="text" placeholder="SpO₂" v-model="info.Spo2">
                </div>
                <div class="form-group">
                    <p for="T">T</p>
                    <input class="form-control" id="T" type="text" placeholder="T" v-model="info.t">
                </div>
                <div class="form-group">
                    <p for="W">W</p>
                    <input class="form-control" id="W" type="text" placeholder="W" v-model="info.w">
                </div>
                <div class="form-group">
                    <p for="BMI">BMI</p>
                    <input class="form-control" id="BMI" type="text" placeholder="BMI" v-model="info.bmi">
                </div>

                <div class="form-group">
                    <p for="thyroid_gland">3. Thyroid gland: </p>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="thyroid_gland1" type="radio" value="normal"
                                v-model="info.thyroid_gland" name="thyroid_gland">
                            <label class="form-check-label mb-0" for="thyroid_gland1">normal</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="thyroid_gland2" type="radio" value="abnormal"
                                v-model="info.thyroid_gland" name="thyroid_gland">
                            <label class="form-check-label mb-0" for="thyroid_gland2">abnormal</label>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <p for="skin">4. Skin: </p>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="skin1" type="radio" value="normal" name="skin"
                                v-model="info.skin">
                            <label class="form-check-label mb-0" for="skin1">normal</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="skin2" type="radio" value="abnormal" name="skin"
                                v-model="info.skin">
                            <label class="form-check-label mb-0" for="skin2">abnormal</label>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <p for="lymph_node">5. Lymph node: </p>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="lymph_node1" type="radio" value="normal"
                                name="lymph_node" v-model="info.lymph_node">
                            <label class="form-check-label mb-0" for="lymph_node1">normal</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="lymph_node2" type="radio" value="abnormal"
                                name="lymph_node" v-model="info.lymph_node">
                            <label class="form-check-label mb-0" for="lymph_node2">abnormal</label>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <p for="lymph_node">6. Respiratory system: </p>

        <div class="form-group">
            <div class="form-group row">
                <p class="col-md-3 col-form-label">Inspection</p>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="respiratory_system_inspection1" type="radio" value="normal"
                            v-model="info.respiratory_system_inspection">
                        <label class="form-check-label mb-0" for="respiratory_system_inspection1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="respiratory_system_inspection2" type="radio"
                            value="abnormal" v-model="info.respiratory_system_inspection" v-model="info.inspection">
                        <label class="form-check-label mb-0" for="respiratory_system_inspection2">abnormal</label>
                    </div>
                </div>
            </div>
            <div class="form-group row" v-if="info.respiratory_system_inspection == 'abnormal'">
                <p class="col-md-3 col-form-label">Repiratory rhythm:</p>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="repiratory_rhythm_regular" type="checkbox" value="regular"
                            v-model="info.repiratory_rhythm_regular">
                        <label class="form-check-label" for="repiratory_rhythm_regular">regular</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="tachypnea" type="checkbox" value="tachypnea"
                            v-model="info.repiratory_rhythm_tachypnea">
                        <label class="form-check-label" for="tachypnea">tachypnea</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="bradypnea" type="checkbox" value="bradypnea"
                            v-model="info.repiratory_rhythm_bradypnea">
                        <label class="form-check-label" for="bradypnea">bradypnea</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="dyspnea" type="checkbox" value="dyspnea"
                            v-model="info.repiratory_rhythm_dyspnea">
                        <label class="form-check-label" for="dyspnea">dyspnea</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="orthopnea" type="checkbox" value="orthopnea"
                            v-model="info.repiratory_rhythm_orthopnea">
                        <label class="form-check-label" for="orthopnea">orthopnea</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="positive_three_depressions_sign" type="checkbox"
                            value="positive_three_depressions_sign"
                            v-model="info.repiratory_rhythm_positive_three_depressions_sign">
                        <label class="form-check-label" for="positive_three_depressions_sign">positive three depressions
                            sign</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="caynosis" type="checkbox" value="caynosis"
                            v-model="info.repiratory_rhythm_caynosis">
                        <label class="form-check-label" for="caynosis">caynosis</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="asymmetric_chest" type="checkbox" value="asymmetric_chest"
                            v-model="info.repiratory_rhythm_asymmetric_chest">
                        <label class="form-check-label" for="asymmetric_chest">asymmetric chest</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="flat_chest" type="checkbox" value="flat_chest"
                            v-model="info.repiratory_rhythm_flat_chest">
                        <label class="form-check-label" for="flat_chest">flat chest</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="barrel_chest" type="checkbox" value="barrel_chest"
                            v-model="info.repiratory_rhythm_barrel_chest">
                        <label class="form-check-label" for="barrel_chest">barrel chest</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="furnnel_chest" type="checkbox" value="furnnel_chest"
                            v-model="info.repiratory_rhythm_furnnel_chest">
                        <label class="form-check-label" for="furnnel_chest">furnnel chest</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pigeon_chest" type="checkbox" value="pigeon_chest"
                            v-model="info.repiratory_rhythm_pigeon_chest">
                        <label class="form-check-label" for="pigeon_chest">pigeon chest</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="subcutanous_emphysema" type="checkbox"
                            value="subcutanous_emphysema" v-model="info.repiratory_rhythm_subcutanous_emphysema">
                        <label class="form-check-label" for="subcutanous_emphysema">subcutanous emphysema</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <p class="col-md-3 col-form-label">Palpation</p>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="respiratory_system_palpation" type="radio" value="normal"
                            name="palpation" v-model="info.respiratory_system_palpation">
                        <label class="form-check-label mb-0" for="respiratory_system_palpation">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="respiratory_system_palpation2" type="radio" value="abnormal"
                            name="palpation" v-model="info.respiratory_system_palpation">
                        <label class="form-check-label mb-0" for="respiratory_system_palpation2">abnormal</label>
                    </div>
                </div>
            </div>
            <div v-if="info.respiratory_system_palpation == 'abnormal'">

                <div class="form-group row">
                    <p class="col-md-3 col-form-label">Describe abnormality :</p>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="describe_abnormality_decrease" type="checkbox"
                                value="decrease" v-model="info.describe_abnormality_decrease">
                            <label class="form-check-label" for="describe_abnormality_decrease">decrease</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="describe_abnormality_in_crease" type="checkbox"
                                value="in_crease" v-model="info.describe_abnormality_in_crease">
                            <label class="form-check-label" for="describe_abnormality_in_crease">in crease</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="describe_abnormality_left_sight" type="checkbox"
                                value="left_sight" v-model="info.describe_abnormality_left_sight">
                            <label class="form-check-label" for="describe_abnormality_left_sight">left sight </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="describe_abnormality_right_sight" type="checkbox"
                                value="right_sight" v-model="info.describe_abnormality_right_sight">
                            <label class="form-check-label" for="describe_abnormality_right_sight">right sight </label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-md-3 col-form-label">Vocal fremitus :</p>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="vocal_fremitus_decrease" type="checkbox"
                                value="decrease" v-model="info.vocal_fremitus_decrease">
                            <label class="form-check-label" for="vocal_fremitus_decrease">decrease</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="vocal_fremitus_in_crease" type="checkbox"
                                value="in_crease" v-model="info.vocal_fremitus_in_crease">
                            <label class="form-check-label" for="vocal_fremitus_in_crease">in crease</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="vocal_fremitus_left_sight" type="checkbox"
                                value="left_sight" v-model="info.vocal_fremitus_left_sight">
                            <label class="form-check-label" for="vocal_fremitus_left_sight">left sight </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="vocal_fremitus_right_sight" type="checkbox"
                                value="right_sight" v-model="info.vocal_fremitus_right_sight">
                            <label class="form-check-label" for="vocal_fremitus_right_sight">right sight </label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Pleural friction fremitus :</label>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="inline-checkbox1" type="checkbox" value="positive"
                                v-model="info.pleural_friction_fremitus_positive">
                            <label class="form-check-label" for="inline-checkbox1">positive</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="inline-checkbox2" type="checkbox" value="negative"
                                v-model="info.pleural_friction_fremitus_negative">
                            <label class="form-check-label" for="inline-checkbox2">negative</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="inline-checkbox3" type="checkbox" value="left_sight"
                                v-model="info.pleural_friction_fremitus_left_sight">
                            <label class="form-check-label" for="inline-checkbox3">left sight </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="inline-checkbox3" type="checkbox" value="right_sight"
                                v-model="info.pleural_friction_fremitus_right_sight">
                            <label class="form-check-label" for="inline-checkbox3">right sight </label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="form-group row">
                <p class="col-md-3 col-form-label">Percussion</p>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="respiratory_system_percussion1" type="radio" value="normal"
                            name="percussion" v-model="info.respiratory_system_percussion">
                        <label class="form-check-label mb-0" for="respiratory_system_percussion1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="respiratory_system_percussion2" type="radio"
                            value="abnormal" name="percussion" v-model="info.respiratory_system_percussion">
                        <label class="form-check-label mb-0" for="respiratory_system_percussion2">abnormal</label>
                    </div>
                </div>
            </div>
            <div v-if="info.respiratory_system_percussion =='abnormal'">
                <div class="form-group row">
                    <p class="col-md-3 col-form-label">Dullness :</p>
                    <div class="col-md-9 col-form-label">

                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="dullness_left_sight" type="checkbox" value="left_sight"
                                v-model="info.dullness_left_sight">
                            <label class="form-check-label" for="dullness_left_sight">left sight </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="dullness_right_sight" type="checkbox"
                                value="right_sight" v-model="info.ullness_right_sight">
                            <label class="form-check-label" for="dullness_right_sight">right sight </label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Tympany :</label>
                    <div class="col-md-9 col-form-label">

                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="tympany_left_sight" type="checkbox" value="left_sight"
                                v-model="info.tympany_left_sight">
                            <label class="form-check-label" for="tympany_left_sight">left sight </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="tympany_right_sight" type="checkbox" value="right_sight"
                                v-model="info.tympany_right_sight">
                            <label class="form-check-label" for="tympany_right_sight">right sight </label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Hyperresonance :</label>
                    <div class="col-md-9 col-form-label">

                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="hyperresonance_left_sight" type="checkbox"
                                value="left_sight" v-model="info.hyperresonance_left_sight">
                            <label class="form-check-label" for="hyperresonance_left_sight">left sight </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="hyperresonance_right_sight" type="checkbox"
                                value="right_sight" v-model="info.hyperresonance_right_sight">
                            <label class="form-check-label" for="hyperresonance_right_sight">right sight </label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="form-group row">
                <p class="col-md-3 col-form-label">Auscultation</p>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="respiratory_system_auscultation1" type="radio"
                            value="normal" v-model="info.respiratory_system_auscultation">
                        <label class="form-check-label mb-0" for="respiratory_system_auscultation1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="respiratory_system_auscultation2" type="radio"
                            value="abnormal" v-model="info.respiratory_system_auscultation">
                        <label class="form-check-label mb-0" for="respiratory_system_auscultation2">abnormal</label>
                    </div>
                </div>
            </div>
            <div v-if="info.respiratory_system_auscultation == 'abnormal'">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Breath sound :</label>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="breath_sound_decrease" type="checkbox" value="decrease"
                                v-model="info.breath_sound_decrease">
                            <label class="form-check-label" for="breath_sound_decrease">decrease</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="breath_sound_in_crease" type="checkbox"
                                value="in_crease" v-model="info.breath_sound_in_crease">
                            <label class="form-check-label" for="breath_sound_in_crease">in crease</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="breath_sound_left_sight" type="checkbox"
                                value="left_sight" v-model="info.breath_sound_left_sight">
                            <label class="form-check-label" for="breath_sound_left_sight">left sight </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="breath_sound_right_sight" type="checkbox"
                                value="right_sight" v-model="info.breath_sound_right_sight">
                            <label class="form-check-label" for="breath_sound_right_sight">right sight </label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">crepitation :</label>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="crepitation_coarse" type="checkbox"
                                v-model="info.crepitation_coarse">
                            <label class="form-check-label" for="crepitation_coarse">coarse</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="crepitation_medium" type="checkbox"
                                v-model="info.crepitation_medium">
                            <label class="form-check-label" for="crepitation_medium">medium</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="crepitation_fine" type="checkbox"
                                v-model="info.crepitation_fine">
                            <label class="form-check-label" for="crepitation_fine">fine </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="crepitation_crepitus" type="checkbox"
                                v-model="info.crepitation_crepitus">
                            <label class="form-check-label" for="crepitation_crepitus">crepitus </label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="crepitation_left_sight" type="checkbox"
                                v-model="info.crepitation_left_sight">
                            <label class="form-check-label" for="crepitation_left_sight">right sight</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="crepitation_right_sight" type="checkbox"
                                v-model="info.crepitation_right_sight">
                            <label class="form-check-label" for="crepitation_right_sight">left sight </label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Wheeze :</label>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="wheeze_sibilant" type="checkbox"
                                v-model="info.wheeze_sibilant">
                            <label class="form-check-label" for="wheeze_sibilant">sibilant</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="wheeze_sonorous" type="checkbox"
                                v-model="info.wheeze_sonorous">
                            <label class="form-check-label" for="wheeze_sonorous">sonorous</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="wheeze_right_sight" type="checkbox"
                                v-model="info.wheeze_right_sight">
                            <label class="form-check-label" for="wheeze_right_sight">right sight</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="wheeze_left_sight" type="checkbox"
                                v-model="info.wheeze_left_sight">
                            <label class="form-check-label" for="wheeze_left_sight">left sight </label>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <p class="col-md-3 col-form-label">Pleural friction rub :</p>
                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="pleural_friction_rub_positive" type="checkbox"
                                v-model="info.pleural_friction_rub_positive">
                            <label class="form-check-label" for="pleural_friction_rub_positive">positive</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="pleural_friction_rub_negative" type="checkbox"
                                v-model="info.pleural_friction_rub_negative">
                            <label class="form-check-label" for="pleural_friction_rub_negative">negative</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="pleural_friction_rub_right_sight" type="checkbox"
                                v-model="info.pleural_friction_rub_right_sight">
                            <label class="form-check-label" for="pleural_friction_rub_right_sight">right sight</label>
                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <input class="form-check-input" id="pleural_friction_rub_left_sight" type="checkbox"
                                v-model="info.pleural_friction_rub_left_sight">
                            <label class="form-check-label" for="pleural_friction_rub_left_sight">left sight </label>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <p>6.Cardiovascular system</p>
        <div class="form-group row">
            <p class="col-md-3 col-form-label">Inspection</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_system_inspection1" type="radio" value="normal"
                        v-model="info.cardiovascular_system_inspection">
                    <label class="form-check-label mb-0" for="cardiovascular_system_inspection1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_system_inspection2" type="radio" value="abnormal"
                        v-model="info.cardiovascular_system_inspection">
                    <label class="form-check-label mb-0" for="cardiovascular_system_inspection2">abnormal</label>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="info.cardiovascular_system_inspection == 'abnormal'">
            <label class="col-md-3 col-form-label">Describe abnormality :</label>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="clubbing_finger" type="checkbox" v-model="info.clubbing_finger">
                    <label class="form-check-label" for="clubbing_finger">Clubbing finger</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="positive_jugular_vein_distention" type="checkbox"
                        v-model="info.positive_jugular_vein_distention">
                    <label class="form-check-label" for="positive_jugular_vein_distention">positive jugular vein
                        distention
                    </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="apical_impulse_at" type="checkbox"
                        v-model="info.apical_impulse_at">
                    <label class="form-check-label" for="apical_impulse_at">apical impulse at </label>
                </div>

            </div>
        </div>

        <div class="form-group row">
            <p class="col-md-3 col-form-label">Palpation</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_system_palpation1" type="radio" value="normal"
                        v-model="info.cardiovascular_system_palpation">
                    <label class="form-check-label mb-0" for="cardiovascular_system_palpation1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_system_palpation2" type="radio" value="abnormal"
                        v-model="info.cardiovascular_system_palpation">
                    <label class="form-check-label mb-0" for="cardiovascular_system_palpation2">abnormal</label>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="info.cardiovascular_system_palpation == 'abnormal'">
            <label class="col-md-3 col-form-label">Thrill :</label>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="mitral_area" type="checkbox" v-model="info.mitral_area">
                    <label class="form-check-label" for="mitral_area">mitral area </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="aortic_area" type="checkbox" v-model="info.aortic_area">
                    <label class="form-check-label" for="aortic_area">aortic area </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="tricuspid_area" type="checkbox" v-model="info.tricuspid_area">
                    <label class="form-check-label" for="tricuspid_area">tricuspid area </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="pulmonary_area" type="checkbox" v-model="info.pulmonary_area">
                    <label class="form-check-label" for="pulmonary_area">pulmonary area </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="left_ventricular_heave" type="checkbox"
                        v-model="info.left_ventricular_heave">
                    <label class="form-check-label" for="left_ventricular_heave">Left ventricular heave
                    </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="right_ventricular_heave" type="checkbox"
                        v-model="info.right_ventricular_heave">
                    <label class="form-check-label" for="right_ventricular_heave">right ventricular heave
                    </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="pericardial_friction_fremitus" type="checkbox"
                        v-model="info.pericardial_friction_fremitus">
                    <label class="form-check-label" for="pericardial_friction_fremitus">pericardial friction fremitus
                    </label>
                </div>

            </div>
        </div>


        <div class="form-group row">
            <p class="col-md-3 col-form-label">Percussion</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_system_percussion1" type="radio" value="normal"
                        v-model="info.cardiovascular_system_percussion">
                    <label class="form-check-label mb-0" for="cardiovascular_system_percussion1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_system_percussion2" type="radio" value="abnormal"
                        v-model="info.cardiovascular_system_percussion">
                    <label class="form-check-label mb-0" for="cardiovascular_system_percussion2">abnormal</label>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="info.cardiovascular_system_percussion == 'abnormal'">
            <label class="col-md-3 col-form-label">Describe abnormality :</label>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="left_sight_enlargement" type="checkbox"
                        v-model="info.left_sight_enlargement">
                    <label class="form-check-label" for="left_sight_enlargement">Left sight enlargement</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="right_sight_enlargement" type="checkbox"
                        v-model="info.right_sight_enlargement">
                    <label class="form-check-label" for="right_sight_enlargement">right sight enlargement </label>
                </div>
            </div>
        </div>


        <div class="form-group row">
            <p class="col-md-3 col-form-label">Auscultation</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_system_auscultation1" type="radio" value="normal"
                        v-model="info.cardiovascular_system_auscultation">
                    <label class="form-check-label mb-0" for="cardiovascular_system_auscultation1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="cardiovascular_system_auscultation2" type="radio"
                        value="abnormal" v-model="info.cardiovascular_system_auscultation">
                    <label class="form-check-label mb-0" for="cardiovascular_system_auscultation2">abnormal</label>
                </div>
            </div>
        </div>
        <div v-if="info.cardiovascular_system_auscultation == 'abnormal'">
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Heart rate:</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="tachycardia" type="checkbox" v-model="info.tachycardia">
                        <label class="form-check-label" for="tachycardia">tachycardia</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="bradycardia" type="checkbox" v-model="info.bradycardia">
                        <label class="form-check-label" for="bradycardia">bradycardia</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">rhythm:</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="regular" type="checkbox" v-model="info.regular">
                        <label class="form-check-label" for="regular">regular</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="arrhythmia" type="checkbox" v-model="info.arrhythmia">
                        <label class="form-check-label" for="arrhythmia">arrhythmia</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Heart sound:</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="S1_decrease" type="checkbox" v-model="info.S1_decrease">
                        <label class="form-check-label" for="S1_decrease">S1 decrease</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="S2_decrease" type="checkbox" v-model="info.S2_decrease">
                        <label class="form-check-label" for="S2_decrease">S2 decrease</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="S1_increase" type="checkbox" v-model="info.S1_increase">
                        <label class="form-check-label" for="S1_increase">S1 increase</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="S2_increase" type="checkbox" v-model="info.S2_increase">
                        <label class="form-check-label" for="S2_increase">S2 increase</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="S1_splitting" type="checkbox" v-model="info.S1_splitting">
                        <label class="form-check-label" for="S1_splitting">S1 splitting</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="S2_splitting" type="checkbox" v-model="info.S2_splitting">
                        <label class="form-check-label" for="S2_splitting">S2 splitting</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="general_splitting" type="checkbox"
                            v-model="info.general_splitting">
                        <label class="form-check-label" for="general_splitting">general splitting </label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="fixed_splitting" type="checkbox"
                            v-model="info.fixed_splitting">
                        <label class="form-check-label" for="fixed_splitting">fixed splitting</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="paradoxical_splitting" type="checkbox"
                            v-model="info.paradoxical_splitting">
                        <label class="form-check-label" for="paradoxical_splitting">paradoxical splitting </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Extra cardiac sound:</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="gallop_rhythm" type="checkbox" v-model="info.gallop_rhythm">
                        <label class="form-check-label" for="gallop_rhythm">gallop rhythm</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="protodiastolic_gallop" type="checkbox"
                            v-model="info.protodiastolic_gallop">
                        <label class="form-check-label" for="protodiastolic_gallop">protodiastolic gallop </label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="late_diastolic_gallop" type="checkbox"
                            v-model="info.late_diastolic_gallop">
                        <label class="form-check-label" for="late_diastolic_gallop">late diastolic gallop </label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="summation_gallop" type="checkbox"
                            v-model="info.summation_gallop">
                        <label class="form-check-label" for="summation_gallop">summation gallop</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="opening_snap" type="checkbox" v-model="info.opening_snap">
                        <label class="form-check-label" for="opening_snap">Opening snap </label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pericardial_knock" type="checkbox"
                            v-model="info.pericardial_knock">
                        <label class="form-check-label" for="pericardial_knock">pericardial knock </label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="tumor_plop" type="checkbox" v-model="info.tumor_plop">
                        <label class="form-check-label" for="tumor_plop">tumor plop</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="click" type="checkbox" v-model="info.click">
                        <label class="form-check-label" for="click">click</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label">Cardiac murmur:</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="systolic" type="checkbox" v-model="info.systolic">
                        <label class="form-check-label" for="systolic">systolic</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="diastolic" type="checkbox" v-model="info.diastolic">
                        <label class="form-check-label" for="diastolic">diastolic</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="continuous" type="checkbox" v-model="info.continuous">
                        <label class="form-check-label" for="continuous">continuous</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="crescendo" type="checkbox" v-model="info.crescendo">
                        <label class="form-check-label" for="crescendo">Crescendo</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="decrescendo" type="checkbox" v-model="info.decrescendo">
                        <label class="form-check-label" for="decrescendo">decrescendo</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="plateau" type="checkbox" v-model="info.plateau">
                        <label class="form-check-label" for="plateau">plateau</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Pericardial friction sound :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pericardial_friction_sound_positive" type="checkbox"
                            v-model="info.pericardial_friction_sound_positive">
                        <label class="form-check-label" for="pericardial_friction_sound_positive">positive</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pericardial_friction_sound_negative" type="checkbox"
                            v-model="info.pericardial_friction_sound_negative">
                        <label class="form-check-label" for="pericardial_friction_sound_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pericardial_friction_sound_continuous" type="checkbox"
                            v-model="info.pericardial_friction_sound_continuous">
                        <label class="form-check-label" for="pericardial_friction_sound_continuous">continuous</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pericardial_friction_sound_crescendo" type="checkbox"
                            v-model="info.pericardial_friction_sound_crescendo">
                        <label class="form-check-label" for="pericardial_friction_sound_crescendo">Crescendo</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pericardial_friction_sound_decrescendo" type="checkbox"
                            v-model="info.pericardial_friction_sound_decrescendo">
                        <label class="form-check-label" for="pericardial_friction_sound_decrescendo">decrescendo</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pericardial_friction_sound_plateau" type="checkbox"
                            v-model="info.pericardial_friction_sound_plateau">
                        <label class="form-check-label" for="pericardial_friction_sound_plateau">plateau</label>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col">

        <p>7.Gastrointestinal system</p>

        <div class="form-group row">
            <p class="col-md-3 col-form-label">Inspection</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastrointestinal_system_inspection1" type="radio" value="normal"
                        v-model="info.gastrointestinal_system_inspection">
                    <label class="form-check-label mb-0" for="gastrointestinal_system_inspection1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastrointestinal_system_inspection2" type="radio"
                        value="abnormal" v-model="info.gastrointestinal_system_inspection">
                    <label class="form-check-label mb-0" for="gastrointestinal_system_inspection2">abnormal</label>
                </div>
            </div>
        </div>
        <div class="form-group row" v-if="info.gastrointestinal_system_inspection == 'abnormal'">
            <label class="col-md-3 col-form-label">Describe abnormality :</label>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="abdominal_distension" type="checkbox"
                        v-model="info.abdominal_distension">
                    <label class="form-check-label" for="abdominal_distension">Abdominal distension</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="abdominal_concavity" type="checkbox"
                        v-model="info.abdominal_concavity">
                    <label class="form-check-label" for="abdominal_concavity">abdominal concavity</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="spider_nevi" type="checkbox" v-model="info.spider_nevi">
                    <label class="form-check-label" for="spider_nevi">spider nevi </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="caput_medusa" type="checkbox" v-model="info.caput_medusa">
                    <label class="form-check-label" for="caput_medusa">caput medusa </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="palmar_erythema" type="checkbox" v-model="info.palmar_erythema">
                    <label class="form-check-label" for="palmar_erythema">palmar erythema </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="duputrens_contracture" type="checkbox"
                        v-model="info.duputrens_contracture">
                    <label class="form-check-label" for="duputrens_contracture">duputren’s contracture</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="leukonychia" type="checkbox" v-model="info.leukonychia">
                    <label class="form-check-label" for="leukonychia">leukonychia</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastral_pattern" type="checkbox" v-model="info.gastral_pattern">
                    <label class="form-check-label" for="gastral_pattern">Gastral pattern</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="intestinal_pattern" type="checkbox"
                        v-model="info.intestinal_pattern">
                    <label class="form-check-label" for="intestinal_pattern">intestinal pattern </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="peristalsis" type="checkbox" v-model="info.peristalsis">
                    <label class="form-check-label" for="peristalsis">peristalsis</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <p class="col-md-3 col-form-label">Palpation</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastrointestinal_system_palpation1" type="radio" value="normal"
                        v-model="info.gastrointestinal_system_palpation">
                    <label class="form-check-label mb-0" for="gastrointestinal_system_palpation1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastrointestinal_system_palpation2" type="radio"
                        value="abnormal" v-model="info.gastrointestinal_system_palpation">
                    <label class="form-check-label mb-0" for="gastrointestinal_system_palpation2">abnormal</label>
                </div>
            </div>
        </div>
        <div class="form-group row" v-if="info.gastrointestinal_system_palpation == 'abnormal'">
            <label class="col-md-3 col-form-label">Tenderness :</label>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="ruq" type="checkbox" v-model="info.ruq">
                    <label class="form-check-label" for="ruq">RUQ</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="rlq" type="checkbox" v-model="info.rlq">
                    <label class="form-check-label" for="rlq">RLQ</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="luq" type="checkbox" v-model="info.luq">
                    <label class="form-check-label" for="luq">LUQ</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="llq" type="checkbox" v-model="info.llq">
                    <label class="form-check-label" for="llq">LLQ</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="rebound_tenderness" type="checkbox"
                        v-model="info.rebound_tenderness">
                    <label class="form-check-label" for="rebound_tenderness">rebound tenderness </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="positive_peritoneal_irritation_sign" type="checkbox"
                        v-model="info.positive_peritoneal_irritation_sign">
                    <label class="form-check-label" for="positive_peritoneal_irritation_sign">Positive Peritoneal
                        irritation
                        sign </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="positive_murphy_sign" type="checkbox"
                        v-model="info.positive_murphy_sign">
                    <label class="form-check-label" for="positive_murphy_sign">Positive murphy sign </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <p class="col-md-3 col-form-label">Percussion</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastrointestinal_percussion1" type="radio" value="normal"
                        v-model="info.gastrointestinal_percussion">
                    <label class="form-check-label mb-0" for="gastrointestinal_percussion1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastrointestinal_percussion2" type="radio" value="abnormal"
                        v-model="info.gastrointestinal_percussion">
                    <label class="form-check-label mb-0" for="gastrointestinal_percussion2">abnormal</label>
                </div>
            </div>
        </div>
        <div class="form-group row" v-if="info.gastrointestinal_percussion == 'abnormal'">
            <label class="col-md-3 col-form-label">General abdominal percussion :</label>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="resonance" type="checkbox" v-model="info.resonance">
                    <label class="form-check-label" for="resonance">resonance</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="dullness" type="checkbox" v-model="info.dullness">
                    <label class="form-check-label" for="dullness">dullness</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="hyperresonance" type="checkbox" v-model="info.hyperresonance">
                    <label class="form-check-label" for="hyperresonance">hyperresonance</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="positive_fluid_thrill" type="checkbox"
                        v-model="info.positive_fluid_thrill">
                    <label class="form-check-label" for="positive_fluid_thrill">Positive fluid thrill </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="shifting_dullness" type="checkbox"
                        v-model="info.shifting_dullness">
                    <label class="form-check-label" for="shifting_dullness">shifting dullness </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="positive_peritoneal_irritation" type="checkbox"
                        v-model="info.positive_peritoneal_irritation">
                    <label class="form-check-label" for="positive_peritoneal_irritation">Positive Peritoneal irritation
                        sign </label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="positive_murphy_sign" type="checkbox"
                        v-model="info.positive_murphy_sign">
                    <label class="form-check-label" for="positive_murphy_sign">Positive murphy sign </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <p class="col-md-3 col-form-label">Auscultation</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastrointestinal_auscultation1" type="radio" value="normal"
                        v-model="info.gastrointestinal_auscultation">
                    <label class="form-check-label mb-0" for="gastrointestinal_auscultation1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="gastrointestinal_auscultation2" type="radio" value="abnormal"
                        v-model="info.gastrointestinal_auscultation">
                    <label class="form-check-label mb-0" for="gastrointestinal_auscultation2">abnormal</label>
                </div>
            </div>
        </div>
        <div class="form-group row" v-if="info.gastrointestinal_auscultation == 'abnormal'">
            <label class="col-md-3 col-form-label">Bowel sound :</label>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="bowel_sound_increase" type="checkbox"
                        v-model="info.bowel_sound_increase">
                    <label class="form-check-label" for="bowel_sound_increase">increase</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="bowel_sound_decrease" type="checkbox"
                        v-model="info.bowel_sound_decrease">
                    <label class="form-check-label" for="bowel_sound_decrease">decrease</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="bowel_sound_decrease_positive_abdominal_aortic_bruits"
                        type="checkbox" v-model="info.bowel_sound_decrease_positive_abdominal_aortic_bruits">
                    <label class="form-check-label" for="bowel_sound_decrease_positive_abdominal_aortic_bruits">positive
                        abdominal aortic bruits
                    </label>
                </div>
            </div>
        </div>
        <p>8.Urinary system </p>
        <div class="form-group row">
            <p class="col-md-3 col-form-label">Inspection</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_inspection1" type="radio" value="normal"
                        v-model="info.urinary_system_inspection">
                    <label class="form-check-label mb-0" for="urinary_system_inspection1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_inspection2" type="radio" value="abnormal"
                        v-model="info.urinary_system_inspection">
                    <label class="form-check-label mb-0" for="urinary_system_inspection2">abnormal</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <p class="col-md-3 col-form-label">Palpation</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_palpation1" type="radio" value="normal"
                        v-model="info.urinary_system_palpation">
                    <label class="form-check-label mb-0" for="urinary_system_palpation1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_palpation2" type="radio" value="abnormal"
                        v-model="info.urinary_system_palpation">
                    <label class="form-check-label mb-0" for="urinary_system_palpation2">abnormal</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <p class="col-md-3 col-form-label">Percussion</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_percussion1" type="radio" value="normal"
                        v-model="info.urinary_system_percussion">
                    <label class="form-check-label mb-0" for="urinary_system_percussion1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_percussion2" type="radio" value="abnormal"
                        v-model="info.urinary_system_percussion">
                    <label class="form-check-label mb-0" for="urinary_system_percussion2">abnormal</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <p class="col-md-3 col-form-label">Auscultation</p>
            <div class="col-md-9 col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_auscultation1" type="radio" value="normal"
                        v-model="info.urinary_system_auscultation">
                    <label class="form-check-label mb-0" for="urinary_system_auscultation1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_auscultation2" type="radio" value="abnormal"
                        v-model="info.urinary_system_auscultation">
                    <label class="form-check-label mb-0" for="urinary_system_auscultation2">abnormal</label>
                </div>
            </div>
        </div>
        <p>9.skeleton </p>
        <div class="form-group row">
            <div class="col col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_skeleton1" type="radio" value="normal"
                        v-model="info.urinary_system_skeleton">
                    <label class="form-check-label mb-0" for="urinary_system_skeleton1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_skeleton2" type="radio" value="abnormal"
                        v-model="info.urinary_system_skeleton">
                    <label class="form-check-label mb-0" for="urinary_system_skeleton2">abnormal</label>
                </div>
            </div>
        </div>
        <p>10.Nervous system </p>
        <div class="form-group row">
            <div class="col col-form-label">
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_nervous_system1" type="radio" value="normal"
                        v-model="info.urinary_system_nervous_system">
                    <label class="form-check-label mb-0" for="urinary_system_nervous_system1">normal</label>
                </div>
                <div class="form-check form-check-inline mr-1">
                    <input class="form-check-input" id="urinary_system_nervous_system2" type="radio" value="abnormal"
                        v-model="info.urinary_system_nervous_system">
                    <label class="form-check-label mb-0" for="urinary_system_nervous_system2">abnormal</label>
                </div>
            </div>
        </div>

        <div v-if="info.urinary_system_nervous_system == 'abnormal'">

            <p>General appearance</p>
            <div class="form-group">
                <label for="heent">Glasgow coma score</label>
                <input class="form-control" id="glasgow_coma_score" type="text" placeholder="Glasgow coma score"
                    v-model="info.glasgow_coma_score">
            </div>
            <p>Cranial nerve</p>
            <div class="form-group">
                <label for="heent">Olfactory nerve</label>
                <input class="form-control" id="olfactory_nerve" type="text" placeholder="Olfactory nerve"
                    v-model="info.olfactory_nerve">
            </div>
            <div class="form-group">
                <label for="heent">Optic nerve</label>
                <input class="form-control" id="optic_nerve" type="text" placeholder="Optic nerve"
                    v-model="info.optic_nerve">
            </div>
            {{-- <div class="form-group">
            <label for="heent">Oculomotor, trochlear, abducent nerves</label>
            <input class="form-control" id="heent" type="text" placeholder="Heent" v-model="info.heent">
        </div> --}}
            <div class="form-group">
                <label for="heent">Trigeminal nerve:</label>
                <input class="form-control" id="trigeminal_nerve" type="text" placeholder="Trigeminal nerve"
                    v-model="info.trigeminal_nerve">
            </div>
            <div class="form-group">
                <label for="heent">Facial nerve:</label>
                <input class="form-control" id="facial_nerve" type="text" placeholder="Facial nerve"
                    v-model="info.facial_nerve">
            </div>
            <div class="form-group">
                <label for="heent">Vestibulocochlear nerve:</label>
                <input class="form-control" id="vestibulocochlear_nerve" type="text"
                    placeholder="vestibulocochlear nerve" v-model="info.vestibulocochlear_nerve">
            </div>
            <div class="form-group">
                <label for="heent">Glossopharyngeal nerve:</label>
                <input class="form-control" id="glossopharyngeal_nerve" type="text" placeholder="Glossopharyngeal nerve"
                    v-model="info.glossopharyngeal_nerve">
            </div>
            <div class="form-group">
                <label for="heent">Vagal nerve:</label>
                <input class="form-control" id="vagal_nerve" type="text" placeholder="Vagal nerve"
                    v-model="info.vagal_nerve">
            </div>
            <div class="form-group">
                <label for="heent">Accessory nerve:</label>
                <input class="form-control" id="accessory_nerve" type="text" placeholder="Accessory nerve"
                    v-model="info.accessory_nerve">
            </div>
            <div class="form-group">
                <label for="heent">Hypoglossal nerve:</label>
                <input class="form-control" id="hypoglossal_nerve" type="text" placeholder="Heent"
                    v-model="info.hypoglossal_nerve">
            </div>
            <p>Motor system</p>
            <div class="form-group">
                <label for="heent">Muscle bulk:</label>
                <input class="form-control" id="muscle_bulk" type="text" placeholder="Heent" v-model="info.muscle_bulk">
            </div>
            <div class="form-group">
                <label for="heent">Muscular tension:</label>
                <input class="form-control" id="muscular_tension" type="text" placeholder="Heent"
                    v-model="info.muscular_tension">
            </div>
            <div class="form-group">
                <label for="heent">Muscle strength:</label>
                <input class="form-control" id="muscle_strength" type="text" placeholder="Muscle strength"
                    v-model="info.muscle_strength">
            </div>
            <p>Coordination movement</p>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Finger-nose test :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="finger_nose_test_negative" type="checkbox"
                            v-model="info.finger_nose_test_negative">
                        <label class="form-check-label" for="finger_nose_test_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="finger_nose_test_positive" type="checkbox"
                            v-model="info.finger_nose_test_positive">
                        <label class="form-check-label" for="finger_nose_test_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Heel to shin test :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="heel_to_shin_test_negative" type="checkbox"
                            v-model="info.heel_to_shin_test_negative">
                        <label class="form-check-label" for="heel_to_shin_test_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="heel_to_shin_test_positive" type="checkbox"
                            v-model="info.heel_to_shin_test_positive">
                        <label class="form-check-label" for="heel_to_shin_test_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Rapid alternating movement :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="rapid_alternating_movement_negative" type="checkbox"
                            v-model="info.rapid_alternating_movement_negative">
                        <label class="form-check-label" for="rapid_alternating_movement_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="rapid_alternating_movement_positive" type="checkbox"
                            v-model="info.rapid_alternating_movement_positive">
                        <label class="form-check-label" for="rapid_alternating_movement_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Tandem walking :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="tandem_walking_negative" type="checkbox"
                            v-model="info.tandem_walking_negative">
                        <label class="form-check-label" for="tandem_walking_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="tandem_walking_positive" type="checkbox"
                            v-model="info.tandem_walking_positive">
                        <label class="form-check-label" for="tandem_walking_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Romberg test :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="romberg_test_negative" type="checkbox"
                            v-model="info.romberg_test_negative">
                        <label class="form-check-label" for="romberg_test_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="romberg_test_positive" type="checkbox"
                            v-model="info.romberg_test_positive">
                        <label class="form-check-label" for="romberg_test_positive">positive</label>
                    </div>
                </div>
            </div>
            <p>Sensory system test</p>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Pain :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pain_increase" type="checkbox" v-model="info.pain_increase">
                        <label class="form-check-label" for="pain_increase">increase</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="pain_decrease" type="checkbox" v-model="info.pain_decrease">
                        <label class="form-check-label" for="pain_decrease">decrease</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Light touch :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="light_touch1" type="radio" value="normal"
                            v-model="info.light_touch">
                        <label class="form-check-label mb-0" for="light_touch1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="light_touch2" type="radio" value="abnormal"
                            v-model="info.light_touch">
                        <label class="form-check-label mb-0" for="light_touch2">abnormal</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Position test :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="position_test1" type="radio" value="normal"
                            v-model="info.position_test">
                        <label class="form-check-label mb-0" for="position_test1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="position_test2" type="radio" value="abnormal"
                            v-model="info.position_test">
                        <label class="form-check-label mb-0" for="position_test2">abnormal</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Point localization :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="point_localization1" type="radio" value="normal"
                            v-model="info.point_localization">
                        <label class="form-check-label mb-0" for="point_localization1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="point_localization2" type="radio" value="abnormal"
                            v-model="info.point_localization">
                        <label class="form-check-label mb-0" for="point_localization2">abnormal</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">temperature :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="temperature1" type="radio" value="normal"
                            v-model="info.temperature">
                        <label class="form-check-label mb-0" for="temperature1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="temperature2" type="radio" value="abnormal"
                            v-model="info.temperature">
                        <label class="form-check-label mb-0" for="temperature2">abnormal</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">vibration :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="vibration1" type="radio" value="normal"
                            v-model="info.vibration">
                        <label class="form-check-label mb-0" for="vibration1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="vibration2" type="radio" value="abnormal"
                            v-model="info.vibration">
                        <label class="form-check-label mb-0" for="vibration2">abnormal</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">two-point discrimination :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="two_point_discrimination1" type="radio" value="normal"
                            v-model="info.two_point_discrimination">
                        <label class="form-check-label mb-0" for="two_point_discrimination1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="two_point_discrimination0" type="radio" value="abnormal"
                            v-model="info.two_point_discrimination">
                        <label class="form-check-label mb-0" for="two_point_discrimination0">abnormal</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">stereognosis test :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="stereognosis_test1" type="radio" value="normal"
                            v-model="info.stereognosis_test">
                        <label class="form-check-label mb-0" for="stereognosis_test1">normal</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="stereognosis_test2" type="radio" value="abnormal"
                            v-model="info.stereognosis_test">
                        <label class="form-check-label mb-0" for="stereognosis_test2">abnormal</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="heent">Reflex test :</label>
                <input class="form-control" id="reflex_test" type="text" placeholder="Reflex test"
                    v-model="info.reflex_test">
            </div>
            <p>Pathologic reflex</p>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Babinski sign :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="babinski_sign_negative" type="checkbox"
                            v-model="info.babinski_sign_negative">
                        <label class="form-check-label" for="babinski_sign_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="babinski_sign_positive" type="checkbox"
                            v-model="info.babinski_sign_positive">
                        <label class="form-check-label" for="babinski_sign_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Oppenheim sign :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="oppenheim_sign_negative" type="checkbox"
                            v-model="info.oppenheim_sign_negative">
                        <label class="form-check-label" for="oppenheim_sign_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="oppenheim_sign_positive" type="checkbox"
                            v-model="info.oppenheim_sign_positive">
                        <label class="form-check-label" for="oppenheim_sign_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">chaddock sign :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="chaddock_sign_negative" type="checkbox"
                            v-model="info.chaddock_sign_negative">
                        <label class="form-check-label" for="chaddock_sign_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="chaddock_sign_positive" type="checkbox"
                            v-model="info.chaddock_sign_positive">
                        <label class="form-check-label" for="chaddock_sign_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Hoffmann sign :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="hoffmann_sign_negative" type="checkbox"
                            v-model="info.hoffmann_sign_negative">
                        <label class="form-check-label" for="hoffmann_sign_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="hoffmann_sign_positive" type="checkbox"
                            v-model="info.hoffmann_sign_positive">
                        <label class="form-check-label" for="hoffmann_sign_positive">positive</label>
                    </div>
                </div>
            </div>
            <p>Meningeal irritation sign</p>

            <div class="form-group row">
                <label class="col-md-3 col-form-label">Kerning sign :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="kerning_sign_negative" type="checkbox"
                            v-model="info.kerning_sign_negative">
                        <label class="form-check-label" for="kerning_sign_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="kerning_sign_positive" type="checkbox"
                            v-model="info.kerning_sign_positive">
                        <label class="form-check-label" for="kerning_sign_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">brudzinski sign :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="brudzinski_sign_negative" type="checkbox"
                            v-model="info.brudzinski_sign_negative">
                        <label class="form-check-label" for="brudzinski_sign_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="brudzinski_sign_positive" type="checkbox"
                            v-model="info.brudzinski_sign_positive">
                        <label class="form-check-label" for="brudzinski_sign_positive">positive</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Stiff neck :</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="stiff_neck_negative" type="checkbox"
                            v-model="info.stiff_neck_negative">
                        <label class="form-check-label" for="stiff_neck_negative">negative</label>
                    </div>
                    <div class="form-check form-check-inline mr-1">
                        <input class="form-check-input" id="stiff_neck_positive" type="checkbox"
                            v-model="info.stiff_neck_positive">
                        <label class="form-check-label" for="stiff_neck_positive">positive</label>
                    </div>
                </div>
            </div>
        </div>

        <p>11.Comment </p>
        <div class="form-group row">
            <div class="col col-form-label">
                <wysiwyg v-model="info.comment" v-validate="''" id="perex" name="perex" :config="mediaWysiwygConfig">
                </wysiwyg>
            </div>
        </div>

    </div>
</div>
