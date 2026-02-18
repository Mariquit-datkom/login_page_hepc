function showReferralDetails(data) {
    const modal = document.getElementById('referralModal');

    document.getElementById('modalReferralId').value = data.ojt_referral_id;
    document.getElementById('modalDisplayId').innerText = data.ojt_referral_display_id;
    document.getElementById('modalDate').innerText = `${data.referral_date}  - ${data.referral_time}`;
    document.getElementById('modalSubmittedBy').innerText = data.referred_by;
    document.getElementById('modalEmployeeNo').innerText = data.employee_no;
    document.getElementById('modalInternName').innerText = data.ojt_full_name;
    document.getElementById('modalInternCourse').innerText = data.ojt_course;
    document.getElementById('modalHoursNeeded').innerText = data.ojt_total_hours_needed;
    document.getElementById('modalInternSchool').innerText = data.ojt_school;

    const statusBadge = document.getElementById('modalStatus');
    statusBadge.innerText = data.status;
    statusBadge.className = 'status-badge ' + data.status.toLowerCase();
    
    const attachmentSection = document.getElementById('attachmentSection');
    const attachmentContainer = document.getElementById('modalAttachment');

    if (data.ojt_cv && data.ojt_cv.trim() !== "") {
        attachmentSection.style.display = 'block';
        
        const folderName = data.ojt_referral_display_id;
        const fileName = data.ojt_cv;

        attachmentContainer.innerHTML = `
            <div class="attachment-item">
                <a href="uploads/referrals/${folderName}/${fileName}" target="_blank" class="attachment-link">
                    <i class="fas fa-file-download"></i> ${fileName}
                </a>
            </div>
        `;

    } else {
        attachmentSection.style.display = 'none'; 
    }

    modal.style.display = 'block';
}

function closeModal() {
    document.getElementById('referralModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('referralModal');
    if (event.target == modal) {
        closeModal();
    }
};