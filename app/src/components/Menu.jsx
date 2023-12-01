import { Link } from 'react-router-dom'
import React from 'react'

/**
 * Page selection menu component
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in writing this code
 */
export default function Menu () {
  const items = [
    { name: 'Home', path: '/' },
    { name: 'Countries', path: '/countries' },
    { name: 'Content', path: '/content' }
  ]
  const itemsJsx = items.map((item) => {
    return (
      <li className='hover:bg-background-highlight' key={item.name}>
        <Link to={item.path}>{item.name}</Link>
      </li>
    )
  })

  return (
    <nav className='bg-background-topbottom text-foreground-topbottom'>
      <ul className='flex flex-col md:flex-row justify-evenly'>
        {itemsJsx}
      </ul>
    </nav>
  )
}
