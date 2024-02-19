<?php

return [
    'provinces' => [
        'Vientiane Prefecture (ນະຄອຫຼວງວຽງຈັນ)' => 'Vientiane Prefecture (ນະຄອຫຼວງວຽງຈັນ)',
        'Attapeu (ອັດຕະປື)' => 'Attapeu (ອັດຕະປື)',
        'Bokeo (ບໍແກ້ວ)' => 'Bokeo (ບໍແກ້ວ)',
        'Bolikhamxai (ບໍລິຄຳໄຊ)' => 'Bolikhamxai (ບໍລິຄຳໄຊ)',
        'Champasak (ຈຳປາສັກ)' => 'Champasak (ຈຳປາສັກ)',
        'Houaphan (ຫົວພັນ)' => 'Houaphan (ຫົວພັນ)',
        'Khammouan (ຄຳມ່ວນ)' => 'Khammouan (ຄຳມ່ວນ)',
        'Louang Namtha ຫຼວງນ້ຳທາ' => 'Louang Namtha ຫຼວງນ້ຳທາ',
        'Louang Prabang (ຫຼວງພະບາງ)' => 'Louang Prabang (ຫຼວງພະບາງ)',
        'Oudomxai' => 'Oudomxai',
        'Phongsali (ຜົງສາລີ)' => 'Phongsali (ຜົງສາລີ)',
        'Salavan (ສາລະວັນ)' => 'Salavan (ສາລະວັນ)',
        'Savannakhet (ສະຫວັນນະເຂດ)' => 'Savannakhet (ສະຫວັນນະເຂດ)',
        'Vientiane (ວຽງຈັນ)' => 'Vientiane (ວຽງຈັນ)',
        'Sainyabuli (ໄຊຍະບູລີ)' => 'Sainyabuli (ໄຊຍະບູລີ)',
        'sekong (ເຊກອງ)' => 'sekong (ເຊກອງ)',
        'Xiangkhoang (ຊຽງຂວາງ)' => 'Xiangkhoang (ຊຽງຂວາງ)',
    ],

    'positions' => [
        'no_postion' => 'ວ່າງ',
        'Admin' => 'Admin',
        'Doctor' => 'Doctor',
        'Nurse' => 'Nurse',
    ],


    'actions' => [
        'back' => 'Back',
    ],
    'admin-user' => [
        'title' => 'Admin Users',

        'actions' => [
            'index' => 'Admin Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',

            //Belongs to many relations
            'roles' => 'Roles',

        ],
    ],

    'role' => [
        'title' => 'Roles',

        'actions' => [
            'index' => 'Roles',
            'create' => 'New Role',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'guard_name' => 'Guard name',

        ],
    ],

    'permission' => [
        'title' => 'Permissions',

        'actions' => [
            'index' => 'Permissions',
            'create' => 'New Permission',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'guard_name' => 'Guard name',

        ],
    ],

    'user' => [
        'title' => 'Patients',

        'actions' => [
            'index' => 'Patients',
            'create' => 'New Patient',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'surname' => "Surname",
            'phone' => "Phone",
            'email' => "Email",
            'email_verified_at' => "Email verified at",
            'password' => "Password",
            'password_repeat' => "Password Confirmation",

            //Belongs to many relations
            'roles' => "Roles",

        ],
    ],

    'department' => [
        'title' => 'Departments',

        'actions' => [
            'index' => 'Departments',
            'create' => 'New Department',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'department_code' => 'Department Code',
            'department_phone' => 'Department Phone',

        ],
    ],

    'patient-history' => [
        'title' => 'Patient Histories',

        'actions' => [
            'index' => 'Patient Histories',
            'create' => 'New Patient History',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'patient_id' => 'Patient',
            'weight' => 'Weight',
            'temperature' => 'Temperature',
            'test_at' => 'Test at',

        ],
    ],


    'book-an-appointment' => [
        'title' => 'Book An Appointments',

        'actions' => [
            'index' => 'Book An Appointments',
            'create' => 'New Book An Appointment',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'user_id' => 'User',

        ],
    ],

    'queue' => [
        'title' => 'Queues',

        'actions' => [
            'index' => 'Queues',
            'create' => 'New Queue',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'patient_id' => 'Patient',
            'employee_id' => 'Employee',
            'queues_status' => 'Queues status',
            'comment' => 'Comment',

        ],
    ],

    'medicine' => [
        'title' => 'Medicines',

        'actions' => [
            'index' => 'Medicines',
            'create' => 'New Medicines',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'brand_name' => 'Brand Name',
            'cheminal_name' => 'Cheminal Name',
            'dose' => 'Dose',
            'type' => 'Type',
            'manufacture_date' => 'Manufacture Date',
            'best_before_date' => 'Best Before Date',
            'cost' => 'Cost',
            'price' => 'Price',
            'amount' => 'Amount',
            'min_amount' => 'Min Amount',

        ],
    ],

    'examination' => [
        'title' => 'Examinations',

        'actions' => [
            'index' => 'Examinations',
            'create' => 'New Examinations',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
        ],
    ],

    'booking-time' => [
        'title' => 'Booking Times',

        'actions' => [
            'index' => 'Booking Times :name',
            'create' => 'New Booking Times',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status_time' => 'Status Time',
        ],
    ],

    'employee-status' => [
        'title' => 'Employee Status',

        'actions' => [
            'index' => 'Employee Status :name',
            'create' => 'New Employee Status',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
        ],
    ],

    'lab' => [
        'title' => 'Labs',

        'actions' => [
            'index' => 'Labs',
            'create' => 'New Labs',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
        ],
    ],

    'lab-detail' => [
        'title' => 'Lab Details',

        'actions' => [
            'index' => 'Lab Details',
            'create' => 'New Lab Details',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'lab_id' => 'Lab',
            'name' => 'Name',
            'unit' => 'Unit',
            'reference' => 'Reference',
            'cost' => 'Cost',
            'price' => 'Price',
        ],
    ],

    'service' => [
        'title' => 'Services',

        'actions' => [
            'index' => 'Services',
            'create' => 'New Services',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',

        ],
    ],

    'exclude-date' => [
        'title' => 'Exclude Dates',

        'actions' => [
            'index' => 'Exclude Dates',
            'create' => 'New Exclude Date',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'exclude_dates' => 'Exclude dates',

        ],
    ],

    'booking-date' => [
        'title' => 'Booking Dates',

        'actions' => [
            'index' => 'Booking Dates',
            'create' => 'New Booking Date',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'last_date' => 'Last date',

        ],
    ],

    'exclude-date' => [
        'title' => 'Exclude Dates',

        'actions' => [
            'index' => 'Exclude Dates',
            'create' => 'New Exclude Date',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'date' => 'Date',

        ],
    ],

    'booking-date' => [
        'title' => 'Booking Dates',

        'actions' => [
            'index' => 'Booking Dates',
            'create' => 'New Booking Date',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'last_date' => 'Last date',

        ],
    ],

    'exclude-date' => [
        'title' => 'Exclude Dates',

        'actions' => [
            'index' => 'Exclude Dates',
            'create' => 'New Exclude Date',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'date' => 'Date',

        ],
    ],


    'branch' => [
        'title' => 'Branches',

        'actions' => [
            'index' => 'Branches',
            'create' => 'New Branch',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'addres' => 'Addres',
            'map' => 'Map',
            'tel' => 'Tel',
            'email' => 'Email',

        ],
    ],


    'promotion' => [
        'title' => 'Promotions',

        'actions' => [
            'index' => 'Promotions',
            'create' => 'New Promotion',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'short_desc' => 'Short desc',
            'link' => 'Link',

        ],
    ],

    'health-tip' => [
        'title' => 'Health Tips',

        'actions' => [
            'index' => 'Health Tips',
            'create' => 'New Health Tip',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'short_desc' => 'Short desc',
            'detail' => 'Detail',

        ],
    ],

    'examination-service' => [
        'title' => 'Examination Services',

        'actions' => [
            'index' => 'Examination Services',
            'create' => 'New Examination Service',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'patient_history_id' => 'Patient history',
            'service_id' => 'Service',
            'lab_id' => 'Lab',
            'lab_detail_id' => 'Lab detail',
            'value' => 'Value',

        ],
    ],

    'basic-physical-examination' => [
        'title' => 'Basic Physical Examinations',

        'actions' => [
            'index' => 'Basic Physical Examinations',
            'create' => 'New Basic Physical Examination',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'patient_id' => 'Patient',
            'pressure' => 'Pressure',
            'weight' => 'Weight',
            'temperature' => 'Temperature',

        ],
    ],

    'upload' => [
        'title' => 'Uploads',

        'actions' => [
            'index' => 'Uploads',
            'create' => 'New Upload',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'lab_id' => 'Lab',
            'patient_history_id' => 'Patient history',

        ],
    ],

    'medicine-history' => [
        'title' => 'Medicine Histories',

        'actions' => [
            'index' => 'Medicine Histories',
            'create' => 'New Medicine History',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'medicine_id' => 'Medicine',
            'cost' => 'Cost',
            'price' => 'Price',
            'status_approved' => 'Status approved',

        ],
    ],

    'prescribe-medicine' => [
        'title' => 'Prescribe Medicines',

        'actions' => [
            'index' => 'Prescribe Medicines',
            'create' => 'New Prescribe Medicine',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'shopping-cart' => [
        'title' => 'Shopping Carts',

        'actions' => [
            'index' => 'Shopping Carts',
            'create' => 'New Shopping Cart',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'medicine_id' => 'Medicine',
            'cost' => 'Cost',
            'price' => 'Price',
            'amount' => 'Amount',

        ],
    ],

    'get-medicine' => [
        'title' => 'Get Medicines',

        'actions' => [
            'index' => 'Get Medicines',
            'create' => 'New Get Medicine',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'package' => [
        'title' => 'Packages',

        'actions' => [
            'index' => 'Packages',
            'create' => 'New Package',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',

        ],
    ],

    'summary' => [
        'title' => 'Summaries',

        'actions' => [
            'index' => 'Summaries',
            'create' => 'New Summary',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'supplier' => [
        'title' => 'Suppliers',

        'actions' => [
            'index' => 'Suppliers',
            'create' => 'New Supplier',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',

        ],
    ],

    'doctor-medicine' => [
        'title' => 'Doctor Medicines',

        'actions' => [
            'index' => 'Doctor Medicines',
            'create' => 'New Doctor Medicine',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'amount' => 'Amount',
            'cheminal_name' => 'Cheminal name',
            'patient_history_id' => 'Patient history',

        ],
    ],

    'brand' => [
        'title' => 'Brands',

        'actions' => [
            'index' => 'Brands',
            'create' => 'New Brand',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',

        ],
    ],

    'category' => [
        'title' => 'Categories',

        'actions' => [
            'index' => 'Categories',
            'create' => 'New Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',

        ],
    ],

    'medicine-pricing' => [
        'title' => 'Medicine Pricing',

        'actions' => [
            'index' => 'Medicine Pricing',
            'create' => 'New Medicine Pricing',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'base_price' => 'Base price',
            'best_before_date' => 'Best before date',
            'manufacture_date' => 'Manufacture date',
            'medicine_id' => 'Medicine',

        ],
    ],

    'medicine-pricing' => [
        'title' => 'Medicine Pricing',

        'actions' => [
            'index' => 'Medicine Pricing',
            'create' => 'New Medicine Pricing',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'amount' => 'Amount',
            'base_price' => 'Base price',
            'best_before_date' => 'Best before date',
            'manufacture_date' => 'Manufacture date',
            'medicine_id' => 'Medicine',
            'supplier_id' => 'Supplier',

        ],
    ],

    'exam-package' => [
        'title' => 'Exam Packages',

        'actions' => [
            'index' => 'Exam Packages',
            'create' => 'New Exam Package',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'employee_id' => 'Employee',
            'package_id' => 'Package',
            'status' => 'Status',

        ],
    ],

    'exchange' => [
        'title' => 'Exchanges',

        'actions' => [
            'index' => 'Exchanges',
            'create' => 'New Exchange',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'thb' => 'Thb',
            'usb' => 'Usb',

        ],
    ],

    'notification-reception' => [
        'title' => 'Notification Receptions',

        'actions' => [
            'index' => 'Notification Receptions',
            'create' => 'New Notification Reception',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'caller' => 'Caller',
            'class' => 'Class',
            'patient' => 'Patient',

        ],
    ],

    'wage' => [
        'title' => 'Wages',

        'actions' => [
            'index' => 'Wages',
            'create' => 'New Wage',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'price' => 'Price',

        ],
    ],

    'exchange' => [
        'title' => 'Exchanges',

        'actions' => [
            'index' => 'Exchanges',
            'create' => 'New Exchange',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'thb' => 'Thb',
            'usd' => 'Usd',

        ],
    ],

    'basic-physical-examination' => [
        'title' => 'Basic Physical Examinations',

        'actions' => [
            'index' => 'Basic Physical Examinations',
            'create' => 'New Basic Physical Examination',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'patient_id' => 'Patient',
            'pr' => 'PR',
            'pressure' => 'Pressure',
            'spo2' => 'Spo2',
            'ta' => 'TA',
            'temperature' => 'Temperature',
            'weight' => 'Weight',
            'rr' => 'RR',
            'bp' => 'BP',

        ],
    ],

    'province' => [
        'title' => 'Provinces',

        'actions' => [
            'index' => 'Provinces',
            'create' => 'New Province',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'en_name' => 'En name',
            'la_name' => 'La name',

        ],
    ],

    'district' => [
        'title' => 'Districts',

        'actions' => [
            'index' => 'Districts',
            'create' => 'New District',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'province_id' => 'Province',

        ],
    ],

    'patient-statistic' => [
        'title' => 'Patient Statistics',

        'actions' => [
            'index' => 'Patient Statistics',
            'create' => 'New Patient Statistic',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'lab-xray-echo' => [
        'title' => 'Labxrayecho',

        'actions' => [
            'index' => 'Labxrayecho',
            'create' => 'New Labxrayecho',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'profit' => [
        'title' => 'Profit',

        'actions' => [
            'index' => 'Profit',
            'create' => 'New Profit',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];
