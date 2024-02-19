import {
    DoctorStatus,
    AssignQueueToDoctor,
    PrescribeMedicines,
    Payment,
    GetMidicine,
    NotificationRecepltion,
    ExaminationService
} from './event-bus/app-events';

Vue.component('component-notification', {
    props: [
        'reception',
        'assignDoctorId',
    ],
    data: function () {
        return {
            audio: null,
        }
    },
    created() {
        this.audio = new Audio('../audio/sound.mp3'); // path to file
        // this.audio = new Audio('https://soundbible.com//mp3/service-bell_daniel_simion.mp3'); // path to file
    },
    mounted() {
        window.Echo.private('to-lab.' + this.reception)
            .listen('SendToLab', (e) => {
                this.$eventBus.publish(new ExaminationService());
                this.audio.play();
            });
        window.Echo.private('employee-status-event')
            .listen('DoctorOnline', (e) => {
                this.$eventBus.publish(new DoctorStatus());
            });
        window.Echo.private('assign-queue-to-doctor.' + this.assignDoctorId)
            .listen('AssignQueueToDoctor', (e) => {
                this.$eventBus.publish(new AssignQueueToDoctor());
                this.audio.play();
            });

        window.Echo.private('Reception.' + this.reception)
            .listen('CallPatient', (e) => {
                this.$notify({
                    type: 'success',
                    title: 'Call Patient!',
                    text: 'Call  : ' + e.patient
                });
                this.$eventBus.publish(new NotificationRecepltion());
                this.audio.play();

            });
        window.Echo.private('Examination')
            .listen('Examination', (e) => {
                if (e.examination == 'pharmacy') {
                    this.$eventBus.publish(new PrescribeMedicines());
                    // this.audio.play();
                }

                if (e.examination == 'payment') {
                    this.$eventBus.publish(new Payment());
                    // this.audio.play();
                }
                if (e.examination == 'pay_already') {
                    this.$eventBus.publish(new GetMidicine());
                    // this.audio.play();

                }
            });

        window.Echo.connector.socket.on('connect', (e) => {
            console.log('connect');
        });

        window.Echo.connector.socket.on('disconnect', (e) => { });

        window.Echo.connector.socket.on('reconnecting', (e) => {
            console.log('reconnecting');
        });


    },

});
