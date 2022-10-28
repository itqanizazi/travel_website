import React, { Component } from 'react'
import ReactDOM from 'react-dom'

import CalendarHeatmap from 'react-calendar-heatmap'
import 'react-calendar-heatmap/dist/styles.css'


import FullCalendar from '@fullcalendar/react' // must go before plugins
import dayGridPlugin from '@fullcalendar/daygrid' // a plugin!


import axios from 'axios'

import uuid from 'uuid/v4'

class TestPage extends Component {

  constructor(props){
    super(props);

    this.state = {
      order_id: props.order_id,
      title: 'Hello World as',
      subtitle: 'Makan makan',
      array: [],
      bookings: [],
      weekendsVisible: true,
      currentEvents: []
    }

    
    
  }

  componentDidMount() {
    
    axios.get('/api/test_data').then(res=>{
      console.log(res.data);
      this.setState({
        array: res.data.places

  
      })
    })

    axios.get('/api/bookings').then(res=>{
      console.log(res.data);
      this.setState({
        bookings: res.data.bookings

  
      })
    })
  }


  render() {
    return (
    <React.Fragment>
    <div className="container">
      <h1>{this.state.title}</h1>
      <h2>{this.state.subtitle}</h2>
        <button className="btn btn-primary btn-sm"
            onClick={()=>{

                // alert('Hello');

                this.setState({
                    title: "hOLLA aMIGO",
                    subtitle: "minum air"
                })

            }}
        >Hello</button>

        <hr/>

        <ul>
          
          {
            this.state.array.map(item => {
              return (
                <li>{item.name}</li>
              )})
          }
        </ul>




        

      {this.props.order_id} /

      {this.state.order_id}

      


     
     

      <FullCalendar
        plugins={[ dayGridPlugin ]}
        initialView="dayGridMonth"

        // weekends={false}
       // events={[
        //  { title:'event 1', start: '2022-10-05', end: '2022-10-07' },
        //  { title: 'event 2', start: '2022-10-02' }
       // ]}

       events= {this.state.bookings}
      />
     


      {/* <h3>Heatmap</h3> */}
{/*
      <CalendarHeatmap
        startDate={new Date('2021-01-01')}
        endDate={new Date('2021-12-31')}
        values={[
          { date: '2021-01-01', count: 12 },
          { date: '2021-01-22', count: 122 },
          { date: '2021-01-30', count: 38 },
          // ...and so on
        ]}
      /> */}

    </div>
    </React.Fragment>
    );
  }

  renderSidebarEvent() {
    return (
      <div className='demo-app-sidebar'>
        <div className='demo-app-sidebar-section'>
          <h2>Instructions</h2>
          <ul>
            <li>Select dates and you will be prompted to create a new event</li>
            <li>Drag, drop, and resize events</li>
            <li>Click an event to delete it</li>
          </ul>
        </div>
        <div className='demo-app-sidebar-section'>
          <label>
            <input
              type='checkbox'
              checked={this.state.weekendsVisible}
              onChange={this.handleWeekendsToggle}
            ></input>
            toggle weekends
          </label>
        </div>
        <div className='demo-app-sidebar-section'>
          <h2>All Events ({this.state.currentEvents.length})</h2>
          <ul>
            {this.state.currentEvents.map(renderSidebarEvent)}
          </ul>
        </div>
      </div>
    )
  }

  handleWeekendsToggle = () => {
    this.setState({
      weekendsVisible: !this.state.weekendsVisible
    })
  }

  handleDateSelect = (selectInfo) => {
    let title = prompt('Please enter a new title for your event')
    let calendarApi =  selectInfo.view.calendar

    calendarApi.unselect() //clear date selection

    if(title) {
      calendarApi.addEvent({
        id: createEventId(),
        title,
        start: selectInfo.startStr,
        end: selectInfo.endStr,
        allDay: selectInfo.allDay
      })
    }
  }

  handleEventClick = (clickInfo) => { // bind with an arrow function
    if (confirm(`Are you sure you want to delete the event '${clickInfo.event.title}'`)) {
      clickInfo.event.remove()
    }
  }

  handleEvents = (events) => {
    this.setState({
      currentEvents: events
    })
  }

}

function renderEventContent(eventInfo) {
  return (
    <>
      <b>{eventInfo.timeText}</b>
      <i>{eventInfo.event.title}</i>
    </>
  )
}

function renderSidebarEvent(event) {
  return (
    <li key={event.id}>
      <b>{formatDate(event.start, {year: 'numeric', month: 'short', day: 'numeric'})}</b>
      <i>{event.title}</i>
    </li>
  )
}





export default TestPage;

if (document.getElementById("root")) {

  const element = document.getElementById('root');
  const props = Object.assign({},element.dataset); 



  ReactDOM.render(<TestPage {...props} />, document.getElementById("root"));
}
