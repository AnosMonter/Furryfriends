function getSevenDays() {
    const daysOfWeek = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
    const result = [];
    const days = [];
    const today = new Date();

    for (let i = 0; i < 7; i++) {
        const newDate = new Date(today);
        newDate.setDate(today.getDate() - 7 + i);
        const dayOfWeek = daysOfWeek[newDate.getDay()];
        const formattedDate = newDate.toISOString().split('T')[0];
        days.push(formattedDate);
        result.push(`${dayOfWeek} - ${formattedDate}`);
    }
    return [days, result];
}
async function Get_Data_Seven_Day() {
    const value_date = [];
    const date_on_DB = [];
    try {
        const response = await fetch(`admin/model/thong_ke_model.php?Date1=${getSevenDays()[0][0]}&Date2=${getSevenDays()[0][1]}&Date3=${getSevenDays()[0][2]}
        &Date4=${getSevenDays()[0][3]}&Date5=${getSevenDays()[0][4]}&Date6=${getSevenDays()[0][5]}&Date7=${getSevenDays()[0][6]}`);
        const data = await response.json();
        for (const item of data) {
            if (item.Date && item.Value !== null) {
                date_on_DB.push(item.Date);
                value_date.push(item.Value);
            } else {
                date_on_DB.push(item.Date);
                value_date.push(0);
            }
        }
    } catch (error) {
        console.error('Error fetching data:', error);
        alert('Lỗi khi tải dữ liệu: ' + error.message);
    }
    return [value_date, date_on_DB];
}

async function drawChart() {
    const [value_date, date_on_DB] = await Get_Data_Seven_Day();
    const data = {
        labels: getSevenDays()[1],
        datasets: [{
            label: 'Doanh Thu Trong Tuần',
            data: value_date,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2
        }]
    };

    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}