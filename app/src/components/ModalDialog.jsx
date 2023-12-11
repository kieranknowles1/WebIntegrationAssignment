import { Dialog } from '@headlessui/react'
import PropTypes from 'prop-types'
import React from 'react'

/**
 * ModalDialog component
 * A component to display a modal dialog. Children are rendered in a Dialog.Panel component.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function ModalDialog (props) {
  return (
    <Dialog
      open={props.isOpen}
      onClose={() => props.setOpen(false)}
      className='relative z-50'
    >
      {/** Dark backdrop */}
      <div className='fixed inset-0 bg-black/30' aria-hidden />
      {/* Fullscreen container to center the dialog */}
      <div className='fixed inset-0 flex w-screen h-screen items-center justify-center p-4'>
        <Dialog.Panel className='w-full max-w-xl rounded bg-background-listitem text-foreground-listitem'>
          {props.children}
        </Dialog.Panel>
      </div>
    </Dialog>
  )
  // return <div className='fixed inset-0 bg-black/30' aria-hidden />
}
ModalDialog.propTypes = {
  isOpen: PropTypes.bool.isRequired,
  setOpen: PropTypes.func.isRequired,
  children: PropTypes.element.isRequired
}

export default ModalDialog
