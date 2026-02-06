//Session heartbeat to prevent unnecessary forced log out
async function sendHeartbeat() {
    try {
        const response = await fetch('heartbeat.php', { 
            method: 'POST',
            keepalive: true 
        });
        if (response.ok) {
            console.log("Heartbeat success: " + new Date().toLocaleTimeString());
        } else {
            console.error("Heartbeat server error: " + response.status);
        }
    } catch (e) {
        console.error("Heartbeat failed to send:", e);
    }
}

sendHeartbeat();

setInterval(sendHeartbeat, 5000);