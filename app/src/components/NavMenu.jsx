import { Link } from 'react-router-dom'
import PropTypes from 'prop-types'
import React from 'react'

/**
 * Page selection menu component.
 * Pass in an array of objects with name and path properties to
 * define the menu items.
 *
 * @author Kieran Knowles
 * @generated Github copilot was used to assist in writing this code
 */
export default function NavMenu (props) {
  const itemsJsx = props.items.map((item) => {
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
NavMenu.propTypes = {
  items: PropTypes.arrayOf(PropTypes.shape({
    name: PropTypes.string.isRequired,
    path: PropTypes.string.isRequired
  }))
}
