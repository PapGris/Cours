import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'


function Square () {

  const [value, setValue] = useState(null);

  function handleClick() {
    console.log('cliqué !');
  }
  return (
    <button 
      className="square"
      onClick={handleClick}
    >
      {value}
    </button>
  );
}

export default function Board() {
  return (
    <>
      <div className="boardRow">
        <Square />
        <Square />
        <Square />
      </div>
      <div className="boardRow">
        <Square />
        <Square />
        <Square />
      </div>
      <div className="boardRow">
        <Square />
        <Square />
        <Square />
      </div>
    </>  
);
}

