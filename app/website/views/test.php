<style>
    /* Font import */
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap");

/* Variables */
:root {
  --container: #e0e2e8;
  --topbg: #B30F00;
  --bottombg: #fff;
  --font: "Open Sans", sans-serif;
  --grey: #6c6c6c;
}

/* Global styles */
body, p, h1 {
  margin: 0;
  padding: 0;
  font-family: var(--font);
}

.container {
  background: var(--container);
  position: relative;
  width: 100%;
  height: 100vh;
}

.container .ticket {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.container .basic {
  display: none;
}

/* Airline ticket styles */
.airline {
  display: block;
  height: 575px;
  width: 270px;
  box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.3);
  border-radius: 25px;
  z-index: 3;
}

.airline .top {
  height: 200px;
  background: var(--topbg);
  border-top-right-radius: 25px;
  border-top-left-radius: 25px;
}

.airline .top h1 {
  text-transform: uppercase;
  font-size: 12px;
  letter-spacing: 2;
  text-align: center;
  position: absolute;
  top: 30px;
  left: 50%;
  transform: translateX(-50%);
}

.airline .bottom {
  height: 355px;
  background: var(--bottombg);
  border-bottom-right-radius: 25px;
  border-bottom-left-radius: 25px;
}

.airline .top .big {
  position: absolute;
  top: 90px;
  font-size: 65px;
  font-weight: 700;
  line-height: 0.8;
}

.airline .top .big .from {
  color: var(--topbg);
  text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000;
}

.airline .top .big .to {
  position: absolute;
  left: 32px;
  font-size: 35px;
  display: flex;
  flex-direction: row;
  align-items: center;
}

.airline .top .big .to i {
  margin-top: 5px;
  margin-right: 10px;
  font-size: 15px;
}

.airline .top--side {
  position: absolute;
  right: 35px;
  top: 110px;
  text-align: right;
}

.airline .top--side i {
  font-size: 25px;
  margin-bottom: 18px;
}

.airline .top--side p {
  font-size: 10px;
  font-weight: 700;
}

.airline .top--side p + p {
  margin-bottom: 8px;
}

.airline .bottom p {
  display: flex;
  flex-direction: column;
  font-size: 13px;
  font-weight: 700;
}

.airline .bottom span {
  font-weight: 400;
  font-size: 11px;
  color: var(--grey);
}

.airline .bottom .column {
  margin: 0 auto;
  width: 80%;
  padding: 2rem 0;
}

.airline .bottom .row {
  display: flex;
  justify-content: space-between;
}

.airline .bottom .row--right {
  text-align: right;
}

.airline .bottom .row--center {
  text-align: center;
}

.airline .bottom .row-2 {
  margin: 30px 0 60px 0;
  position: relative;
}

.airline .bottom .row-2::after {
  content: "";
  position: absolute;
  width: 100%;
  bottom: -30px;
  left: 0;
  background: #000;
  height: 1px;
}

.airline .bottom .bar--code {
  height: 50px;
  width: 80%;
  margin: 0 auto;
  position: relative;
}

.airline .bottom .bar--code::after {
  content: "";
  position: absolute;
  width: 6px;
  height: 100%;
  background: #000;
  top: 0;
  left: 0;
  box-shadow: 10px 0 #000, 30px 0 #000, 40px 0 #000, 67px 0 #000, 90px 0 #000, 100px 0 #000, 180px 0 #000, 165px 0 #000, 200px 0 #000, 210px 0 #000, 135px 0 #000, 120px 0 #000;
}

.airline .bottom .bar--code::before {
  content: "";
  position: absolute;
  width: 3px;
  height: 100%;
  background: #000;
  top: 0;
  left: 11px;
  box-shadow: 12px 0 #000, -4px 0 #000, 45px 0 #000, 65px 0 #000, 72px 0 #000, 78px 0 #000, 97px 0 #000, 150px 0 #000, 165px 0 #000, 180px 0 #000, 135px 0 #000, 120px 0 #000;
}

/* Info section styles */
.info {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  bottom: 10px;
  font-size: 14px;
  text-align: center;
  z-index: 1;
}

.info a {
  text-decoration: none;
  color: #000;
  background: var(--topbg);
}

</style>





<div class="container">
    <div class="ticket airline" style="width:320px;height:fit-content">
        <div class="top" >
            <h1>Online Ticket<br>00010</h1>
            <div class="big">
                <p class="from">TRACK</p>
                <p class="to"><i class="fas fa-arrow-right"></i> EXPRESS</p>
            </div>
            <div class="top--side">
                <i class="fas fa-plane"></i>
                <p></p>
                <p> </p>
            </div>
        </div>
        <div class="bottom">
            <div class="column">
                <div class="row row-1">
                    <p><span>Train</span>Podi Manike</p>
                    <p class="row--right"><span>Route</span>Kelaniya Line</p>
                </div>
                <div class="row row-2">
                    <p><span>Departure</span>10:25 AM<br>Kelaniya</p>
                    <!-- <p class="row--center"><span>Departs</span>11:00 AM</p> -->
                    <p class="row--right"><span>Arrives</span>1:05 PM<br>Colombo</p>
                </div>
                <div class="row row-3">
                    <p><span>Passenger</span>Jesus Ramirez<br>0713456977</p>
                    <p class="row--right"><span>Seat</span>5<br>First Class<br>Window seat</p>
                </div>
            </div>
            
        </div>
    </div>

</div>