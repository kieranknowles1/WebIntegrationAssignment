import { useContext } from 'react'

/**
 * useContext hook that throws an error if the context is null
 * @template T - The type of the context excluding null
 * @param {React.Context<T | null>} context
 * @returns {T}
 * @throws {Error} If the context is null
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 */
export default function useNotNullContext (context) {
  const value = useContext(context)
  if (value === null) {
    throw new Error('Context was null')
  }
  return value
}
