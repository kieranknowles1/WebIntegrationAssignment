import React from 'react'
import { Link } from 'react-router-dom'

/**
 * Page selection menu component
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in generating this code
 */
export default function Menu () {
  return (
    <nav>
      <ul>
        <li><Link to='/'>Home</Link></li>
        <li><Link to='/countries'>Countries</Link></li>
        <li><Link to='/content'>Content</Link></li>
      </ul>
    </nav>
  )
}
