﻿import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { CommonModule }   from '@angular/common';

import { AppComponent } from './app.component';
import { jqxBarcodeModule } from 'jqwidgets-ng/jqxbarcode';

@NgModule({
  declarations: [
      AppComponent
  ],
  imports: [
    BrowserModule, CommonModule, jqxBarcodeModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})

export class AppModule { }


