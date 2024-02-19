export class BookingTimeCreatedEvent {
    constructor(type) {
        this.type = type;
    }
}
export class BookingTimeEditEvent {
    constructor(type, item) {
        this.type = type;
        this.item = item;
    }
}

export class DoctorStatus {
    constructor() {}
}

export class ReceptionAssignDoctor {
    constructor() {}
}

export class GetCommentQueue {
    constructor(item) {
        this.item = item;
    }
}
export class AssignQueueToDoctor {
    constructor() {}
}



export class Examination {
    constructor() {}
}
export class ExaminationService {
    constructor() {}
}

export class PrescribeMedicines {
    constructor() {}
}

export class Payment {
    constructor() {}
}


export class ExaminationResult {
    constructor() {}
}

export class ShoppingCard {
    constructor() {}
}
export class GetMidicine {
    constructor() {}
}

export class AppointmentUserCreated {
    constructor(user) {
        this.user = user
    }
}

export class AppointmentUserModalCancel {
    constructor() {}
}
export class NotificationRecepltion {
    constructor() {}
}
export class statusDoctorMedicine {
    constructor(status) {
        this.status = status;
    }
}
