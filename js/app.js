Vue.component('student', {
    props: ['firstName', 'lastName', 'returnTime', 'info', 'status'],
    template: `
        <div class='student'>
            <p>
                {{ firstName }} {{ [...lastName][0] }}. is {{ status }}
                <span v-if='info'> at/with {{ info }}, returning at {{ returnTime }}</span>
            </p>
        </div>`
});

Vue.component('student-list', {
    template: `
        <div class='student-list'>
            <student v-for='student of $root.students' :key='student.studentId' :first-name='student.firstName' :last-name='student.lastName' :status='$root.status_data[student.status]' :return-time='student.returnTime' :info='student.info'></student>
        </div>`
});

//for now I'm putting them in manually, eventually we'll fetch all this from the database of course

var vm = new Vue({
    el: '#attendance',
    data: {
        students: [{
                studentId: 1,
                firstName: 'Eli',
                lastName: 'Kimchi',
                status: 2,
                returnTime: '3:10pm',
                info: 'Uwajimaya'
            },
            {
                studentId: 2,
                firstName: 'Anthony',
                lastName: 'Reyes',
                status: 7
            }
        ],
        status_data: [
            'Not Checked In',
            'Present',
            'Offsite',
            'Field Trip',
            'Checked Out',
            'Late',
            'Independent Study',
            'Absent'
        ]
    }
});