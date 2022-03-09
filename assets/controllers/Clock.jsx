import React, {useEffect, useState} from "react";
import {render, unmountComponentAtNode} from 'react-dom'

function Clock() {
    const [clockState, setClockState] = useState()

    useEffect(() => {
        setInterval(() => {
            const date = new Date()
            setClockState(date.toLocaleTimeString('en-US'))
        }, 1000)
    }, [])
    return (
        <div>{clockState}</div>
    )
}


class ClockElement extends HTMLElement {

    connectedCallback() {
        render(<Clock />, this)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }
}

customElements.define('post-comment', ClockElement)