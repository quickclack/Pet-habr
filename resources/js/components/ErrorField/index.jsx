import React from 'react';
import {Alert, AlertTitle} from '@mui/material';

export const ErrorField = (props) => {
    return (
           <Alert severity="error"> 
           <AlertTitle> Ошибка </AlertTitle>
           {props.error}</Alert>
    )
}